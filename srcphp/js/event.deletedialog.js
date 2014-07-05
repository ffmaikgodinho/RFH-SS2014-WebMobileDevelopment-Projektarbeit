$.widget("event.deleteDialog", $.ui.dialog, {
	options: {
		autoOpen: false,
		modal: true
	},
	
	
	open: function(event) {
		this._event = event;
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
			url: this._event.url,
			success: function() {
				this._trigger("oneventDeleted")
			},
		context: this	
		});
	}
});