$.widget("event.eventCreate", 
{
	_create: function() {
		var that = this;
		this.element.find("#save").click( function()
			{
				that._trigger("onsaveClicked");
				that._saveEvent();
				return false;
			});
		this.element.find("#delete").click( function()
		{
			that._trigger("oncancelClicked");
			return false;
		});
	},
	
	_saveEvent: function() {
			
			alert(" title: " + this.element.find("#title").val() + 
					"\n date: " + this.element.find("#date").val() + " " + this.element.find("#time").val() +
					"\n location: " + this.element.find("#location").val() +
					"\n description: " + this.element.find("#desc").val() +
					"\n type: " + 1);
		
		var event = {
			title: this.element.find("#title").val(),
			date: this.element.find("#date").val() + this.element.find("#time").val(),
			location: this.element.find("#location").val(),
			description: this.element.find("#desc").val(),
			type: 1
		};
		
		$.ajax({
			type: "PUT",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
			data: event,
			success: function() {
				this._trigger("onEventSaved");
				this.close();
			},
			error: function(request) {
				alert(request.responseText);
				
				// this.element.find(".validation_message").empty();
				// this.element.find("#title_field").removeClass("ui-state-error");
				// if (request.status == "400") {
					// var validationMessages = $.parseJSON(request.responseText);
					// if (validationMessages.title) {
						// this.element.find(".validation_message").text(validationMessages.title);
						// this.element.find("#title_field").addClass("ui-state-error").focus();
					// };
				// }
			},
		context: this	
		});
	}
});