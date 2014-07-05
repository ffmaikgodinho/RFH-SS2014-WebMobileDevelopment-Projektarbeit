$.widget("event.eventDetails", {  
	load: function(eventUrl) {
		$.ajax({
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + eventUrl,
			dataType: "json",
			success: function(event)
			{
				this.element.find(".content-title").text(event.title);
				//this.element.find(".creator-name").val(event.creator);
				this.element.find(".event-date").val(event.date);
				this.element.find(".event_time").val(event.date);
				this.element.find(".event-location").val(event.location);
				this.element.find(".event-desc").val(event.description);
			},
			context:this
		});
	}
});