$.widget("event.deleteDialog", $.ui.dialog, {
	options: {
		autoOpen: false,
		modal: true,
		width: 400
	},
	
	
	open: function(ID) {
		this.ID = ID;
		alert(ID);
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
			url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + eventUrl,
			success: function() {
				this._trigger("oneventDeleted")
			},
		context: this	
		});
	}
});