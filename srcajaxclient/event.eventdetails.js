$.widget("event.eventDetails", {  
  load: function(eventUrl) {					// _ bedeutet Privat dies ist wie ein Konstruktor
		$.ajax({
			url: eventUrl,
			dataType: "json",
			success: function(event)
				{
					//alert(event.title);
					this.element.find(".author").text(event.author);
					this.element.find(".due_date").text(event.due_date);
					this.element.find(".title").text(event.title);
					this.element.find(".notes").text(event.notes);
				},
			context:this
		   });
		   this._super();
		}
  });