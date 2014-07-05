$.widget("event.cancelDialog", $.ui.dialog, 
{
	options: {
		autoOpen: false,
		modal: true
	},
	
	open: function() {
		this._super();
	},
	
	_create: function() {
		var that = this;
		this.options.buttons = [
			{
				text: "Ja",
				click: function() {
					that._cancel();
					that.close();
				}
			},
			{
				text: "Nein",
				click: function() {
					that.close();
				}
			}
		];
		this._super();
	},
	
	_cancel: function() {
		this._trigger("oncanceld");
		context: this
	}
});