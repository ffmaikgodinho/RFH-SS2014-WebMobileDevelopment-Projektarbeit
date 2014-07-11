$.widget("event.eventItemList", { 
	 _create: function() 
    {
		$.ajax(
		{
		   url: "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
		   dataType: "json",
		   success: function(){ alert("klappt");},
		   context: this
		});		
	},
});