$.widget("event.eventCreate", 
{
	_create: function() 
	{
		var that = this;
		
		this.element.find("#save").click( function()
			{
				that._trigger("onsaveClicked");
				that._saveEvent();
			});
		this.element.find("#delete").click( function()
		{
			that._trigger("oncancelClicked");
			return false;
		});
		this.element.find("#title").change(function() {
			that.load();
			that._validateEntry();
		});
		this.element.find("#date").change(function() {
			that.load();
			that._validateEntry();
		});
		
	},
	
	load: function() {
		var titleElement = this.element.find("#title");
		var dateElement = this.element.find("#date");
		
		this.element.find("#empty-date").addClass("template");
		this.element.find("#empty-title").addClass("template");
		this.element.find("#no-date").addClass("template")
		dateElement.addClass("event-formfield");
		dateElement.removeClass("empty-required-field");
		titleElement.addClass("event-formfield");
		titleElement.removeClass("empty-required-field");
		titleElement.focus();
	},
	
	_saveEvent: function() 
	{
		var that = this;
		
		var valid = that._validateEntry("valid");
		if (!valid) {
			return;
		};
		
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
				this.hide();
			},
			error: function(request) {
				alert(request.responseText);
				return;
				
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
	},
	
	_validateEntry: function()
	{
		var that = this;
		var titleElement = this.element.find("#title");
		var dateElement = this.element.find("#date");
		var valid = true;
		
		if ((dateElement.val() == "") || (dateElement.val() != "") || (titleElement.val() == "")) {
			if (dateElement.val() == "") {
				valid = false;
				this.element.find("#empty-date").removeClass("template");
				dateElement.removeClass("event-formfield");
				dateElement.addClass("empty-required-field");
				dateElement.focus();
			} else {
				var t = dateElement.val().split(/[- .]/);
				var d = new Date(t[2], t[1]-1, t[0]);
				alert(d);
				if (d == "Invalid Date") {
					valid = false;
					this.element.find("#no-date").removeClass("template");
					dateElement.removeClass("event-formfield");
					dateElement.addClass("empty-required-field");
					dateElement.focus();
				}
			};
			if (titleElement.val() == "") {
				valid = false;
				this.element.find("#empty-title").removeClass("template");
				titleElement.removeClass("event-formfield");
				titleElement.addClass("empty-required-field");
				titleElement.focus();
			};
			return valid;
		};
	return true;
	}
});