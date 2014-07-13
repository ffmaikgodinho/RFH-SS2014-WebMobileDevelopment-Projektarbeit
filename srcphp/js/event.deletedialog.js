$.widget("event.deleteDialog", $.ui.dialog, {
	eventId: "",
	
	options: {
		autoOpen: false,
		modal: true,
		width: 400
	},
	
	
	open: function(eventId) {
		this.eventId = eventId;
		this._super();
	},
	
	_create: function() {
		var that = this;
		this.options.buttons = [
			{
				text: "Löschen",
				click: function() {
					that._deleteevent();
					that.close();
				}
			},
			{
				text: "Abbrechen",
				click: function() {
					that.close();
				}
			}
		];
		this._super();
	},
	
	_deleteevent: function() {
		this.close();
		$.ajax({
			type: "DELETE",
			// dataType: "json",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/" + this.eventId,
			success: function() {
				this._trigger("ondeleted");
			},
			error: function(request) {
				if (request.status == "404") {
					this._trigger("ondeleted");
				}
				else {
					this._trigger("onerror", null, request.responseText);
					return;
				}
			},
		context: this	
		});
	}
});