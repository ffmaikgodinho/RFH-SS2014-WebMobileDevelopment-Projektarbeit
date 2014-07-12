$.widget("event.menuBar", 
{
	_create: function() {
		var that = this;
		this.element.find("#nav_about").click( function()
			{
				that._trigger("onaboutClicked");
				return false;
			});
		
		this.element.find("#nav_new").click( function()
			{
				that._trigger("onnewClicked");
				return false;
			});
			
		this.element.find("#nav_login").click( function()
			{
				that._trigger("onloginClicked");
				return false;
			});
			
		this.element.find("#nav_search").click( function()
			{
				that._trigger("onsearchClicked");
				return false;
			});
	}
});