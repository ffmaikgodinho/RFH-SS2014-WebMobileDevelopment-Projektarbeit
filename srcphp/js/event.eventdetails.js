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
				for (var i = 0; i < event.entrys.length; i++) {
					var entry = event.entrys[i];
					var itemElement = this.element.find(".item-template").clone().removeClass("item-template").addClass("item-filled");
					this.element.find("#clone-item-here").before(itemElement);
					itemElement.find('.item_title').removeClass('item_title-empty');
					itemElement.find('.item_qty').removeClass('item_qty-empty');
					itemElement.find('.item_note').removeClass('item_note-empty');
					itemElement.find('.item_title').val(entry.title);
					itemElement.find('.item_qty').val(entry.total_qty);
					itemElement.find('.item_note').val(entry.note);
					itemElement.find('.item-delete').removeClass("template");
					itemElement.find('.placeholder-item-delete').addClass("template");
					itemElement.find('.item-delete').click(function()
					{
						itemElement.remove();
					});
				}
			},
			error: function(request) {
				alert(request.responseText);
				return;
			},
			context:this
		});
	}
	
});