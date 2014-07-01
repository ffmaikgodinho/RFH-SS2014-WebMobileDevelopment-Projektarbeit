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
			eventElement.find(".list-entry-title").text(event.id);
			eventElement.find(".list-entry-fact-date").text(event.date);
			eventElement.find(".list-entry-fact-location").text(event.location);
			eventElement.click(event.url, function(event)
			{
				that._trigger("oneventClicked", null, event.data);
			});			
			this.element.append(eventElement);
		}
    }
});