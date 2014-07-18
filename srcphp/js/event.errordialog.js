// Dialog zur Anzeige von Fehlermeldungen
// Autor: Denis Kündgen

$.widget("event.errorDialog", $.ui.dialog, {
	options: {
		autoOpen: false,
		modal: true,
		width: 400
	},
	
	open: function(message) {
		this.element.find("#error-message").text(message);
		this._super();
	},
	
	_create: function() {
		var that = this;
		this.options.buttons = [
			{
				text: "Schließen",
				click: function() {
					that.close();
				}
			}
		];
		this._super();
	}
});