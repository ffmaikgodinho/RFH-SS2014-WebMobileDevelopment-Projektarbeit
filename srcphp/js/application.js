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
	
	$("#navigation").menuBar({
		onaboutClicked: function() {
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		},
		onnewClicked: function() {
			$("#event_create").show();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").hide();
		},
		onloginClicked: function() {
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		}
	});
	
	$("#event_show").eventDetails();
	
	$("#event_create").eventEdit();
	
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