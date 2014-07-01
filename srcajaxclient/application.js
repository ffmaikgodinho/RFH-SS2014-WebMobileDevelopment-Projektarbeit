$(function() {
	$(document).ajaxError(function(event, request) {
		$("#error_dialog").errorDialog("open", request.statusText);
		$("#event_details").hide();
		$("#event_list").show();	
		if (request.status == "404") {
			$("#event_list").eventList("reload");
		};
	});
	
	$("#error_dialog").errorDialog();
	
	$("#event_show").eventDetails();
	
	$("#event_list").eventList({
		 oneventClicked: function(event, url) {
			$("#event_show").eventDetails("load", url);
			$("#event_list").hide();
			$("#event_show").show();
		}
	});
	
	$("#content").hide();
	$("#event_show").hide();
	$("#event_create").hide();
	
		
});