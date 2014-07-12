$.widget("event.eventCreate", 
{	
	_create: function() 
	{
		var that = this;
		
		this.element.find("#save").click( function()
			{
				that._trigger("onsaveClicked");
				that._saveEvent();
			});
		this.element.find("#delete").click( function()
		{
			var ID = that.element.find(".event-id").text()
			alert(ID);
			if (ID == "") {
				that._trigger("oncancelClicked");
			} else {
				that._trigger("ondeleteClicked", null, ID);
			};
			
		});
		this.element.find("#title").change(function() {
			that._load();
			validateTitle(that);
		});
		this.element.find("#date").change(function() {
			that._load();
			validateDate(that);
		});
		this.element.find("#location").change(function() {
			that._load();
			validateLocation(that);
		});
		this.element.find("#time").change(function() {
			that._load();
			validateTime(that);
		});
		this.element.find(".item_title").change(function() {
			that._newItem();
		});	
		this.element.find(".item_title").on("keydown", function(e) {
			if ((e.keyCode == 9) || (e.keyCode == 13)) { 
				e.preventDefault();
				that._newItem();
			}
		});	
	},
	
	newEvent: function() {
		var that = this;
		this.element.find(".item-filled").remove();
		this.element.find(".item_note").val("");
		this.element.find(".item_qty").val("");
		this.element.find(".event-formfield").val("").addClass("event-formfield-empty");
		this.element.find(".event-title-formtitle").show();
		this.element.find('.event-title').removeClass('template');
		this.element.find(".event-id").text("")
		that._load();
	},
	
	
	showEvent: function(eventUrl) {
		var that = this;
		that.newEvent();
		$.ajax({
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + eventUrl,
			dataType: "json",
			success: function(event)
			{
				var eventId = event.id;
				this.element.find(".content-title").text(event.title);
				this.element.find(".event-id").text(event.id).addClass("template");
				this.element.find(".event-title-formtitle").hide();
				this.element.find(".event-title").val(event.title).addClass("template");
				//this.element.find(".creator-name").val(event.creator);
				// Split timestamp into [ Y, M, D, h, m, s ]
				var t = event.date.split(/[- :]/);
				// Apply each element to the Date function
				var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
				this.element.find(".event-date").val(d.toLocaleDateString()).removeClass("event-formfield-empty");
				this.element.find(".event-time").val(d.toLocaleTimeString()).removeClass("event-formfield-empty");
				this.element.find(".event-location").val(event.location).removeClass("event-formfield-empty");
				this.element.find(".event-desc").val(event.description).removeClass("event-formfield-empty");
				for (var i = 0; i < event.entrys.length; i++) {
					var entry = event.entrys[i];
					var itemElement = this.element.find(".item-template").clone().removeClass("item-template").addClass("item-filled");
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
					itemElement.find('.item-delete').click(function()
					{
						alert("entry löschen");
						that._deleteItem(itemElement, entry.id);
					});
				}
			},
			error: function(request) {
				alert(request.responseText);
				return;
			},
			context:this
		});
	},
	
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
	
	_saveEvent: function() 
	{
		var that = this;
		
		var valid = that._validateEvent("valid");
		if (!valid) {
			return;
		};
		
		var ID = this.element.find(".event-id").text();
		var httpType = "";
		if (ID != "") {
			httpType = "POST";
			addUrl = "/" + ID;
		} else {
			httpType = "PUT";
			addUrl = "";
		};
		
		alert(" title: " + this.element.find("#title").val() + 
					"\n id: " + ID +
					"\n date: " + this.element.find("#date").val() + " " + this.element.find("#time").val() +
					"\n location: " + this.element.find("#location").val() +
					"\n description: " + this.element.find("#desc").val() +
					"\n type: " + 1 +
					"\n httpType: " + httpType + 
					"\n url: /RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events" + addUrl);
		
		var event = {
			title: this.element.find("#title").val(),
			date: this.element.find("#date").val() + " " + this.element.find("#time").val(),
			location: this.element.find("#location").val(),
			description: this.element.find("#desc").val(),
			type: 1
		};
		
		
		$.ajax({
			type: httpType,
			dataType: "json",
			contentType: "application/json",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events" + addUrl,
			data: JSON.stringify(event),
			success: function(eventId) {
				this._trigger("onEventSaved");
				that.showEvent("/api/events/" + eventId);
				that._saveItems(eventId);
			},
			error: function(request) {
				alert(request.responseText);
				return;
			},
		context: this	
		});
	},
	
	_saveItems: function(eventId) {
		
		$(".item-filled").each(function(index) {
			var title = $(this).find(".item_title").val();
			var total_qty = $(this).find(".item_qty").val();
			var note = $(this).find(".item_note").val();
			//alert(index + ": " + title + " | " + total_qty + " | " + note);
		
			var item = {
				eventid: eventId,
				title: title,
				totalQuantity: total_qty,
				note: note
			};
			
			$.ajax({
				type: "PUT",
				dataType: "json",
				contentType: "application/json",
				url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries",
				data: JSON.stringify(item),
				success: function() {
					alert("item gespeichert!");
				},
				error: function(request) {
					alert(request.responseText);
					return;
				},
			context: this	
			});
		});
	},
	
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
			itemElement.find('.item-delete').click(function()
			{
				itemElement.remove();
			});	
			this.element.find(".item-template").find('.item_title').focus();
		}		
	},
	
	_deleteItem: function(itemElement, itemId) {
		alert(itemId);
		$.ajax({
			type: "DELETE",
			dataType: "json",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries/" + itemId,
			success: function() {
				alert("gelöscht!");
				itemElement.remove();
			},
			error: function(request) {
				alert("ist gelöscht worden, läuft aber ins error!");
				if (request.status == "404") {
					itemElement.remove();
				}
				else {
				alert(request.responseText);
				}
			},
		context: this	
		});
	}
});

