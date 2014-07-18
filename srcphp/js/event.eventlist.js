// Eventliste
// Autor: Denis Kündgen

$.widget("event.eventList", 
{
	// Funktion zum Suchen von Events
	// behandelt außerdem die Seitenauswahl
	search: function(searchString, page)
	{
		// Vorherige Inhalte leeren
		$(".content-page").hide();
		$("#search_string").val("");
		this.element.find(".list-entry:not(.template)").remove();
		var pageString = ""
		
		// Wenn eine Seite übergeben wird muss diese Berücksichtig werden beim Aufruf des Webservice
		if (page != "") {
			pageString = "page" + page;
		};
		
		// Abruf der Daten mit angegebenen Suchtext und ggf. Seitenauswahl
		$.ajax(
		{
		   url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/" + searchString + pageString,
		   dataType: "json",
		   context: this,
		   statusCode: {
				200: function(data, responseText, response) {
					this.element.find("#list-advice").text("");
					// Bei Erfolg private Funktion _appendEvents aufrufen und Parameter übergeben (Objekte, Gesamtseitenanzahl, Suchtext, aktive Seite)
					this._appendEvents(data, response.getResponseHeader("X-MaxPages"), searchString, page);
				},
				204: function() {
					this.element.find(".list-entry:not(.template)").remove();
					this.element.find("#list-advice").text("Ihre Suche ergab keine Treffer...");
					return;
				}
			},
		   error: function(request) {
			}
		});		
	},
	
	
	// Private Funktion zum Anzeigen von Elementen
	// behandelt außerdem den Umgang einer Liste durch Auswahl von Trefferseiten
	_appendEvents: function(events, numpages, searchString, page)
	{
		var that = this;
		
		// Prüfen ob es sich bei den Daten um ein Array handelt
		if (Array.isArray(events)) {
		
			// Prüfen ob die Gesamtseitenanzahl größer 1 ist
			if (numpages > 1) {
				
				// Vorherige Einträge entfernen
				$(".page-selector option").remove();
				
				// Seitenzahl im Content-Bereich anzeigen
				$(".content-page").show();
				
				// Prüfen, ob ein Suchtext mit übergeben wurde. Diesen ggf. um ein / ergänzen zum Zusammenbauen der URL
				if (searchString != "") {
					searchString = searchString + "/";
				};
				
				// Prüfen ob bereits eine Seite angeklickt wurde, um diese im Dropdownmenu anzuzeigen (Auf welcher Seite befindet sich der User gerade)
				if (page != "") {
					$("<option/>").val(page).text(page).appendTo(".page-selector");
					$("<option/>").text("-").attr('disabled',true).appendTo(".page-selector");
				};
				
				// Sicherstellen, das numpages eine Zahl ist
				numpages = parseInt(numpages);
				
				var pageElement = this.element.find(".page-selector");
				
				// Optionen im Dropdownmenu ergänzen und mit Clickfunktion versehen
				for (var p = 0; p < numpages; p++) {
					$("<option/>").val(p+1).text(p+1).appendTo(".page-selector").click(function(){
						that.search(searchString, $('.page-selector').val());
					});
				};
				
				// Gesamtseitenanzahl ausgeben
				this.element.find(".numpages").text(numpages);
			}
			
			// Trefferliste generieren
			for (var i = 0; i < events.length; i++) 
			{
				var event = events[i];
				var eventElement = this.element.find(".template").clone();
				eventElement.removeClass("template");
				eventElement.find(".list-entry-title").text(event.title);
				
				// Timestamp aufteilen [ Y, M, D, h, m, s ]
				var t = event.date.split(/[- :]/);
				// Zum Datum konvertieren
				var d = new Date(t[0], t[1]-1, t[2]);
				// Prüfen, ob das Event bereits stattgefunden hat
				if (d < new Date()) {
					var advice = "beendet am ";
				} else {
					var advice = "";
				};
				
				// Inhalte ausgeben
				eventElement.find(".list-entry-fact-date").text(advice + d.toLocaleDateString());
				eventElement.find(".list-entry-fact-location").text(event.location);
				
				// Klickfunktion einfügen
				eventElement.click(event.url, function(event)
				{
					that._trigger("oneventClicked", null, event.data);
				});
				
				this.element.append(eventElement);
			}
		} else {
			var event = events;
			var eventElement = this.element.find(".template").clone();
			eventElement.removeClass("template");
			eventElement.find(".list-entry-title").text(event.title);
			
			// Timestamp aufteilen [ Y, M, D, h, m, s ]
			var t = event.date.split(/[- :]/);
			// Zum Datum konvertieren
			var d = new Date(t[0], t[1]-1, t[2]);
			// Prüfen, ob das Event bereits stattgefunden hat
			if (d < new Date()) {
				var advice = "beendet am ";
			} else {
				var advice = "";
			};
			// Inhalte ausgeben
			eventElement.find(".list-entry-fact-date").text(advice + d.toLocaleDateString());
			eventElement.find(".list-entry-fact-location").text(event.location);
			event.url = "/api/events/" + event.id;
			
			// Klickfunktion einfügen
			eventElement.click(event.url, function(event)
			{
				that._trigger("oneventClicked", null, event.data);
			});
			
			this.element.append(eventElement);
		};
				
    }
});