$.widget("event.eventDetails", {  
	load: function(eventUrl) {
		$.ajax({
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + eventUrl,
			dataType: "json",
			success: function(event)
			{
				this.element.find(".content-title").text(event.title);
				//this.element.find(".creator-name").val(event.creator);
				
				// Split timestamp into [ Y, M, D, h, m, s ]
				var t = event.date.split(/[- :]/);
				// Apply each element to the Date function
				var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
				
				this.element.find(".event-date").val(d.toLocaleDateString());
				this.element.find(".event-time").val(d.toLocaleTimeString());
				
				this.element.find(".event-location").val(event.location);
				this.element.find(".event-desc").val(event.description);
			},
			context:this
		});
	}
});