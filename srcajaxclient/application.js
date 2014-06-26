$(function() {
	$(document).ajaxError(function(event, request) {
		$("#error_dialog").errorDialog("open", request.statusText);
		$("#event_details").hide();
		$("#event_list").show();	
		if (request.status == "404") {
				$("#event_list").eventList("reload");
			}
		});
	
	$("#error_dialog").errorDialog();
	$("#event_details").eventDetails();
	
	$("#event_list").eventList({
		oneventClicked: function(event, url) {
			//var url = "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp" + url;
			alert("event geklickt: " + url);
			$("#event_show").eventDetails("load", url);
			$("#event_list").hide();
			$("#event_details").show();
		},
	});
	
	
	
	$("#delete_dialog").deleteDialog({
		oneventDeleted: function() {
		$("#event_list").eventList("reload");
		},
	});
	
	$("#content").hide();
	$("#event_create").hide();
	$("#event_show").hide();
	
	//alert("application");
	
});