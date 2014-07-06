$.widget("event.eventList", 
{
    _create: function() 
    {
		$.ajax(
		{
		   url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   dataType: "json",
		   success: this._appendEvents,
		   context: this
		});		
	},
		  
	_load: function()
	{
		$.ajax(
		{
		   url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   dataType: "json",
		   success: this._appendEvents,
		   context: this
		});		
	},
		
	reload: function()
	{
		this.element.find(".event:not(.template)").remove();
		$.ajax(
		{
		   url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   dataType: "json",
		   success: this._appendEvents,
		   context: this
		});		
	},
	
	_appendEvents: function(events)
	{
		var that = this;
		for (var i = 0; i < events.length; i++) 
		{
			var event = events[i];
			var eventElement = this.element.find(".list-entry").clone();
			eventElement.removeClass("template");
			eventElement.find(".list-entry-title").text(event.title);
			// Split timestamp into [ Y, M, D, h, m, s ]
			var t = event.date.split(/[- :]/);
			// Apply each element to the Date function
			var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
			eventElement.find(".list-entry-fact-date").text(d.toLocaleDateString());
			eventElement.find(".list-entry-fact-location").text(event.location);
			eventElement.click(event.url, function(event)
			{
				that._trigger("oneventClicked", null, event.data);
			});			
			this.element.append(eventElement);
		}
    }
});