// Dialog zum Bestätigen eines Abbruchs einer Event-Eingabe
// Autor: Denis Kündgen

$.widget("event.cancelDialog", $.ui.dialog, 
{
	options: {
		autoOpen: false,
		modal: true,
		width: 400
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