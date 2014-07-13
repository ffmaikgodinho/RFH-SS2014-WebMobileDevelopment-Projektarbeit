$.widget("event.saveDialog", $.ui.dialog, {
	obj: "",
	
	options: {
		autoOpen: false,
		modal: true,
		width: 400
	},
	
	
	open: function(obj) {
		this.obj = obj;
		this._super();
	},
	
	_create: function() {
		var that = this;
		this.options.buttons = [
			{
				text: "Speichern",
				click: function() {
					that.close();
					that.obj._saveEvent();
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
	}
});