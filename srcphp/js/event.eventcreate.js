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
			that._load();
			validateTitle(that);
		});
		this.element.find("#date").change(function() {
			that._load();
			validateDate(that);
		});
		this.element.find("#location").change(function() {
			that._load();
			validateLocation(that);
		});
		this.element.find("#time").change(function() {
			that._load();
			validateTime(that);
		});
		this.element.find(".item_title").change(function() {
			that._newItem();
		});	
		this.element.find(".item_title").on("keydown", function(e) {
			if ((e.keyCode == 9) || (e.keyCode == 13)) { 
				e.preventDefault();
				that._newItem();
			}
		});			
	},
	
	newEvent: function() {
		var that = this;
		this.element.find(".item-filled").remove();
		//this.element.find(".event-formfield").val("");
		that._load();
	},
	
	_load: function() {
		var titleElement = this.element.find("#title");
		var dateElement = this.element.find("#date");
		var timeElement = this.element.find("#time");
		var locationElement = this.element.find("#location");

		this.element.find("#empty-title").addClass("template");		
		this.element.find("#empty-date").addClass("template");
		this.element.find("#no-date").addClass("template");
		this.element.find("#past-date").addClass("template");
		this.element.find("#no-time").addClass("template");
		this.element.find("#empty-location").addClass("template")
		dateElement.addClass("event-formfield");
		dateElement.removeClass("empty-required-field");
		titleElement.addClass("event-formfield");
		titleElement.removeClass("empty-required-field");
		timeElement.addClass("event-formfield");
		timeElement.removeClass("empty-required-field");
		locationElement.addClass("event-formfield");
		locationElement.removeClass("empty-required-field");
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
			dataType: "json",
			contentType: "application/json",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
			data: JSON.stringify(event),
			success: function(eventId) {
				this._trigger("onEventSaved");
				that._saveItems(eventId);
			},
			error: function(request) {
				alert(request.responseText);
				return;
			},
		context: this	
		});
	},
	
	_saveItems: function(eventId) {
		
		$(".item-filled").each(function(index) {
			var title = $(this).find(".item_title").val();
			var total_qty = $(this).find(".item_qty").val();
			var note = $(this).find(".item_note").val();
			//alert(index + ": " + title + " | " + total_qty + " | " + note);
		
			var item = {
				eventid: eventId,
				title: title,
				totalQuantity: total_qty,
				note: note
			};
			
			$.ajax({
				type: "PUT",
				dataType: "json",
				contentType: "application/json",
				url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries",
				data: JSON.stringify(item),
				success: function() {

				},
				error: function(request) {
					alert(request.responseText);
					return;
				},
			context: this	
			});
		});
	},
	
	_validateEntry: function()
	{
		var that = this;
		var valid = true;
		
		if (validateTitle(that) == false) {
			valid = false;
		};
		
		if (validateDate(that) == false) {
			valid = false;
		};
		
		if (validateTime(that) == false) {
			valid = false;
		};
		
		if (validateLocation(that) == false) {
			valid = false;
		};
		
		return valid;
	},
	
	_newItem: function() {
		var itemTitle = this.element.find(".item-template").find('.item_title');
		if (itemTitle.val() != "") {
			var itemElement = this.element.find(".item-template").clone().removeClass("item-template").addClass("item-filled");
			this.element.find("#clone-item-here").before(itemElement);
			this.element.find(".item-template").find('.item_title').val("");
			this.element.find(".item-template").find('.item_qty').val("");
			this.element.find(".item-template").find('.item_note').val("");
			itemElement.find('.item-delete').removeClass("template");
			itemElement.find('.placeholder-item-delete').addClass("template");
			itemElement.find('.item-delete').click(function()
			{
				itemElement.remove();
			});	
			this.element.find(".item-template").find('.item_title').focus();
		}		
	}
});

