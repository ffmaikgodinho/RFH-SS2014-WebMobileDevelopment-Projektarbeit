// Suchfunktion
// Autor: Denis Kündgen

$.widget("event.menuSearch", 
{
	_create: function() {
		var that = this;
		this.element.find("#search_button").click( function()
			{
				that._trigger("onsearchClicked");
				return false;
			});
	}
});