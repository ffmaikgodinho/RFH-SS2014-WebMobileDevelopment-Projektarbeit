// Event anzeigen
// Event Erstellen/Löschen/Ändern
// Einträge speichern/ergänzen/löschen
// Autor: Denis Kündgen

$.widget("event.eventCreate", 
{	
	_create: function() 
	{
		var that = this;
		
		// Speichern-Knopf belegen (speichern/updaten)
		this.element.find("#save").click( function()
			{
				var ID = that.element.find(".event-id").text()
				if (ID == "") {
					that._saveEvent();
				} else {
					that._trigger("onsaveClicked", null, that);
				};
			});
			
		// Löschen-Knopf belegen (löschen/abbrechen)
		this.element.find("#delete").click( function()
		{
			var ID = that.element.find(".event-id").text()
			if (ID == "") {
				that._trigger("oncancelClicked");
			} else {
				that._trigger("ondeleteClicked", null, ID);
			};
		});
		
		// Validierung: Titel als Pflichtfeld
		this.element.find("#title").change(function() {
			that._load();
			validateTitle(that);
		});
		
		// Validierung: Datumformat und Eingabe überprüfen
		this.element.find("#date").change(function() {
			that._load();
			validateDate(that);
		});
		
		// Validierung: Ort als Pflichtfeld
		this.element.find("#location").change(function() {
			that._load();
			validateLocation(that);
		});
		
		// Validierung: Zeitformat und Eingabe überprüfen
		this.element.find("#time").change(function() {
			that._load();
			validateTime(that);
		});
		
		// Nach Eingabe eines Items eine neue Eingabemaske zur Verfügung stellen
		this.element.find(".item_title").change(function() {
			that._newItem();
		});	
		
		// Wenn "Enter" oder "Tab" verwendet wird, eine neue Eingabemaske zur Verfügung stellen
		this.element.find(".item_title").on("keydown", function(e) {
			if ((e.keyCode == 9) || (e.keyCode == 13)) { 
				e.preventDefault();
				that._newItem();
			}
		});	
	},
	
	
	// Neues Event/Maske leeren
	newEvent: function() {
		var that = this;
		this.element.find(".item-filled").remove();
		this.element.find(".item-show").remove();
		this.element.find(".item_note").val("");
		this.element.find(".item_qty").val("");
		this.element.find(".event-formfield").val("").addClass("event-formfield-empty");
		this.element.find(".content-title").text("Neues Event anlegen");
		this.element.find(".event-title-formtitle").show();
		this.element.find('.event-title').removeClass('template');
		this.element.find(".event-id").text("");
		this.element.find(".event-stamp").text("")
		that._load();
	},
	
	
	// Event laden
	showEvent: function(eventUrl) {
		var that = this;
		
		// Vorherige Elemente entfernen
		that.newEvent();
		
		// Daten abfragen
		$.ajax({
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + eventUrl,
			dataType: "json",
			statusCode: {
				200: function(event) {
					// Inhalte füllen
					var eventId = event.id;
					this.element.find(".content-title").text(event.title);
					this.element.find(".event-id").text(event.id);
					this.element.find(".event-stamp").text(event.stamp);
					this.element.find(".event-title-formtitle").hide();
					this.element.find(".event-title").val(event.title).addClass("template");
					var t = event.date.split(/[- :]/);
					this.element.find(".event-date").val(t[2] + "." + t[1] + "." + t[0]).removeClass("event-formfield-empty");
					this.element.find(".event-time").val(t[3] + ":" + t[4]).removeClass("event-formfield-empty");
					this.element.find(".event-location").val(event.location).removeClass("event-formfield-empty");
					this.element.find(".event-desc").val(event.description).removeClass("event-formfield-empty");
					
					// Einträge (entries) laden
					for (var i = 0; i < event.entrys.length; i++) {
						var entry = event.entrys[i];
						var itemElement = this.element.find(".item-template").clone().removeClass("item-template").addClass("item-show");
						this.element.find("#clone-item-here").before(itemElement);
						itemElement.find('.item_title').removeClass('item_title-empty').attr("readonly", true);
						itemElement.find('.item_qty').removeClass('item_qty-empty').attr("readonly", true);
						itemElement.find('.item_note').removeClass('item_note-empty').attr("readonly", true);
						itemElement.find('.item-id').text(entry.id);
						itemElement.find('.item_title').val(entry.title);
						itemElement.find('.item_qty').val(entry.total_qty);
						itemElement.find('.item_note').val(entry.note);
						itemElement.find('.item-delete').removeClass("template");
						itemElement.find('.placeholder-item-delete').addClass("template");
						itemElement.find('.item-delete').attr("data-id",entry.id.toString()) 
						// Löschen-Knopf mit Klickfunktion belegen
						itemElement.find('.item-delete').click(function()
						{
							that._deleteItem(this, this.getAttribute("data-id"));
						});
					}
				},
				204: function() {
					// Rückmeldung wenn keine Einträge gefunden wurden
					this._trigger("onerror", null, "Der Eintrag existiert nicht mehr! Eventuell wurde dieser zwischenzeitlich durch einen anderen Benutzer gelöscht.");
				}
			},
			error: function(request) {
				// Rückmeldung bei sonstigen Fehlern
				this._trigger("onerror", null, request.responseText);
				return;
			},
			context:this
		});
	},
	
	
	// Hilfsfunktion zum entfernen aller Styles 
	_load: function() {
		var titleElement = this.element.find("#title");
		var dateElement = this.element.find("#date");
		var timeElement = this.element.find("#time");
		var locationElement = this.element.find("#location");

		this.element.find("#empty-title").addClass("template");		
		this.element.find("#empty-date").addClass("template");
		this.element.find("#no-date").addClass("template");
		this.element.find("#past-date").addClass("template");
		this.element.find("#no-time").addClass("template");
		this.element.find("#empty-location").addClass("template")
		dateElement.addClass("event-formfield");
		dateElement.removeClass("empty-required-field");
		titleElement.addClass("event-formfield");
		titleElement.removeClass("empty-required-field");
		timeElement.addClass("event-formfield");
		timeElement.removeClass("empty-required-field");
		locationElement.addClass("event-formfield");
		locationElement.removeClass("empty-required-field");
	},
	
	
	// Event speichern/updaten
	_saveEvent: function() 
	{
		var that = this;
		
		// Prüfen ob alle Eingabe valide sind
		var valid = that._validateEvent("valid");
		if (!valid) {
			return;
		};
		
		// auslesen der ID, sofern vorhanden
		var ID = this.element.find(".event-id").text();
		var httpType = "";
		
		// Wenn ID gefüllt, handelt es sich um ein Update
		if (ID != "") {
			httpType = "POST";
			addUrl = "/" + ID;
		} else {
			httpType = "PUT";
			addUrl = "";
		};
		
		// Objekt zusammenstellen
		var event = {
			title: this.element.find(".event-title").val(),
			date: this.element.find(".event-date").val() + " " + this.element.find("#time").val(),
			location: this.element.find(".event-location").val(),
			description: this.element.find(".event-desc").val(),
			stamp: this.element.find(".event-stamp").text(),
			type: 1
		};
		
		// Event speichern/updaten - Aufruf des Webservice
		$.ajax({
			type: httpType,
			contentType: "application/json",
			headers: {"If-Match": this.element.find(".event-stamp").text()},
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events" + addUrl,
			data: JSON.stringify(event),
			success: function(eventId) {
				var eventIdNumber = ""
				
				// Bei Erfolg ID holen
				if (ID != "") {
					eventIdNumber = ID;
				} else {
					eventIdNumber = eventId;
				};		
				
				// Einträge (entries) speichern 
				that._saveItems(eventIdNumber);
				
				// Event anzeigen
				//that.showEvent("/api/events/" + eventIdNumber);
			},
			error: function(request) {
				// Fehlerbehandlung
				if (request.status == "412") {
					this._trigger("onerror", null, "Der Eintrag wurde zwischenzeitlich verändert und wird nun neu geladen.");
					that.showEvent("/api/events/" + ID);
				} else if (request.status == "400") {
					this._trigger("onerror", null, "Der Eintrag wurde zwischenzeitlich gelöscht. Sie haben nun die Möglichkeit ein neues Event anzulegen.");
					that.newEvent();
				} else {
					this._trigger("onerror", null, request.responseText);
					return;
				}
			},
		context: this	
		});
	},
	
	
	// Einträge (entries) speichern
	_saveItems: function(eventId) {
		
		var that = this;
		var results = [];
		
		// Durch einzelne Einträge (entries) iterieren
		$(".item-filled").each(function(index) {
			var title = $(this).find(".item_title").val();
			var total_qty = $(this).find(".item_qty").val();
			var note = $(this).find(".item_note").val();
		
			// Objekt zusammenstellen
			var item = {
				eventid: eventId,
				title: title,
				totalQuantity: total_qty,
				note: note
			};
			
			// Eintrag speichern - Aufruf des Webservice
			var async = $.ajax({
				type: "PUT",
				dataType: "json",
				contentType: "application/json",
				url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries",
				data: JSON.stringify(item),
				success: function() {
					
				},
				error: function(request) {
					that._trigger("onerror", null, request.responseText);
					return;
				},
			context: this	
			});
			results.push(async);
		});
		
		
		$.when.apply(this, results).done(function() {
			that.showEvent("/api/events/" + eventId);
		});
		
	},
	
	
	// Hilfsmethode zum Validieren aller Einträge vor dem Speichern
	_validateEvent: function()
	{
		var that = this;
		var valid = true;
		
		if (validateTitle(that) == false) {
			valid = false;
		};
		
		if (validateDate(that) == false) {
			valid = false;
		};
		
		if (validateTime(that) == false) {
			valid = false;
		};
		
		if (validateLocation(that) == false) {
			valid = false;
		};
		
		return valid;
	},
	
	
	// Erstellen einer neuen Eingabemaske nach Eingabe eines Eintrags (entries)
	_newItem: function() {
		var itemTitle = this.element.find(".item-template").find('.item_title');
		if (itemTitle.val() != "") {
			var itemElement = this.element.find(".item-template").clone().removeClass("item-template").addClass("item-filled");
			this.element.find("#clone-item-here").before(itemElement);
			this.element.find(".item-template").find('.item_title').val("");
			this.element.find(".item-template").find('.item_qty').val("");
			this.element.find(".item-template").find('.item_note').val("");
			itemElement.find('.item-delete').removeClass("template");
			itemElement.find('.placeholder-item-delete').addClass("template");
			if (itemElement.find('.item_qty').val() == "") {
				itemElement.find('.item_qty').val("1");
			};
			itemElement.find('.item-delete').click(function()
			{
				itemElement.remove();
			});	
			this.element.find(".item-template").find('.item_title').focus();
		}		
	},
	
	
	// Löschen eines Eintrags (entries)
	_deleteItem: function(itemElement, itemId) {
		$.ajax({
			type: "DELETE",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries/" + itemId,
			success: function() {
				$(itemElement).parent().parent().remove();
			},
			error: function(request) {
				if (request.status == "204") {
					$(itemElement).parent().parent().remove();
				}
				else {
					this._trigger("onerror", null, request.responseText);
					return;
				}
			},
		context: this	
		});
	}
});

