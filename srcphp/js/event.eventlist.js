$.widget("event.eventList", 
{
    // _create: function() 
    // {
		// $.ajax(
		// {
		   // url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   // dataType: "json",
		   // success: this._appendEvents,
		   // context: this
		// });		
	// },
		  
	// _load: function()
	// {
		// $.ajax(
		// {
		   // url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   // dataType: "json",
		   // success: this._appendEvents,
		   // context: this
		// });		
	// },
		
	// reload: function()
	// {
		// this.element.find(".event:not(.template)").remove();
		// $.ajax(
		// {
		   // url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   // dataType: "json",
		   // success: this._appendEvents,
		   // context: this
		// });		
	// },
	
	search: function()
	{
		var searchString = $("#search_string").val();
		$("#search_string").val("");
		this.element.find(".list-entry:not(.template)").remove();
		$.ajax(
		{
		   url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/" + searchString,
		   dataType: "json",
		   context: this,
		   statusCode: {
				200: function(data) {
					this.element.find("#list-advice").text("");
					this._appendEvents(data);
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
	
	_appendEvents: function(events)
	{
		var that = this;
		var test = 1;
		if (Array.isArray(events)) {
			for (var i = 0; i < events.length; i++) 
			{
				var event = events[i];
				var eventElement = this.element.find(".template").clone();
				eventElement.removeClass("template");
				eventElement.find(".list-entry-title").text(event.title);
				// Split timestamp into [ Y, M, D, h, m, s ]
				var t = event.date.split(/[- :]/);
				// Apply each element to the Date function
				var d = new Date(t[0], t[1]-1, t[2]);
				if (d < new Date()) {
					var advice = "beendet am ";
				} else {
					var advice = "";
				};
				eventElement.find(".list-entry-fact-date").text(advice + d.toLocaleDateString());
				eventElement.find(".list-entry-fact-location").text(event.location);
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
			// Split timestamp into [ Y, M, D, h, m, s ]
			var t = event.date.split(/[- :]/);
			// Apply each element to the Date function
			var d = new Date(t[0], t[1]-1, t[2]);
			if (d < new Date()) {
				var advice = "beendet am ";
			} else {
				var advice = "";
			};
			eventElement.find(".list-entry-fact-date").text(advice + d.toLocaleDateString());
			eventElement.find(".list-entry-fact-location").text(event.location);
			event.url = "/api/events/" + event.id;
			eventElement.click(event.url, function(event)
			{
				that._trigger("oneventClicked", null, event.data);
			});			
			this.element.append(eventElement);
		};
				
    }
});