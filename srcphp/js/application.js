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
			$("#event_create").eventCreate("load");
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
	
	$("#event_list").eventList({
		oneventClicked: function(event, url) {
			$("#event_show").eventDetails("load", url);
			$("#event_list").hide();
			$("#event_show").show();
		}
	});
	
	$("#event_show").eventDetails({
		onsaveClicked: function() {
			alert("speichern geklickt");
		},
		ondeleteClicked: function() {
			alert("löschen geklickt");
		}
	});
	
	$("#event_create").eventCreate({
		onsaveClicked: function() {
		},
		oncancelClicked: function() {
			$("#cancel-dialog").cancelDialog("open");
		},
		onEventSaved: function() {
			alert("gespeichert!");
			// $("#event_show").eventDetails(url);
		}
	});
	
	$("#cancel-dialog").cancelDialog({
		oncanceld: function() {
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		},
	});
	
	$("#content").hide();
	$("#event_show").hide();
	$("#event_create").hide();
	
		
});