$.widget("event.eventDetails", {  
	load: function(eventUrl) {
		var that = this;
		$.ajax({
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + eventUrl,
			dataType: "json",
			success: function(event)
			{
				var eventId = event.id;
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
				that._loadEntries(eventId);
			},
			error: function(request) {
				alert(request.responseText);
				return;
			},
			context:this
		});
	},
	
	_loadEntries: function(eventId) {		
		$.ajax({
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries/" + eventId,
			dataType: "json",
			success: function(events) {
				alert("rein da!");
				// var that = this;
				// alert(events.length);
				// for (var i = 0; i < entries.length; i++) {
					// var event = events[i];
					// var eventElement = this.element.find(".template").clone();
					// eventElement.removeClass("template");
					// eventElement.find(".list-entry-title").text(event.title);
					// Split timestamp into [ Y, M, D, h, m, s ]
					// var t = event.date.split(/[- :]/);
					// Apply each element to the Date function
					// var d = new Date(t[0], t[1]-1, t[2], t[3], t[4], t[5]);
					// eventElement.find(".list-entry-fact-date").text(d.toLocaleDateString());
					// eventElement.find(".list-entry-fact-location").text(event.location);
					// eventElement.click(event.url, function(event)
					// {
						// that._trigger("oneventClicked", null, event.data);
					// });			
					// this.element.append(eventElement);
				// }
			},
			error: function(request) {
				alert(request.responseText);
				return;
			},
			context:this
		}); 
	}
	
});