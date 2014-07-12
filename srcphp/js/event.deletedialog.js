$.widget("event.deleteDialog", $.ui.dialog, {
	eventId: "",
	
	options: {
		autoOpen: false,
		modal: true,
		width: 400
	},
	
	
	open: function(eventId) {
		this.eventId = eventId;
		alert(eventId);
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
			dataType: "json",
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/" + this.eventId,
			success: function() {
				alert("gelöscht!");
				// this._trigger("oneventDeleted")
			},
			error: function(request) {
				alert("ist gelöscht worden, läuft aber ins error!");
				if (request.status == "404") {
					$("#event_create").hide();
					$("#event_list").hide();
					$("#event_show").hide();
					$("#content").show();
				}
				else {
				alert(request.responseText);
				}
			},
		context: this	
		});
	}
});