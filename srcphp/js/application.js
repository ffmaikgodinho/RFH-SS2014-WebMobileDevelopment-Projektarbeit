$(function() {
	$(document).ajaxError(function(event, request) {
		$("#error_dialog").errorDialog("open", request.statusText);
		$("#event_details").hide();
		$("#event_list").show();	
		if (request.status == "404") {
			$("#event_list").eventList("reload");
		};
	});
	
	$("#error-dialog").errorDialog();
	
	$("#navigation").menuBar({
		onaboutClicked: function() {
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		},
		onnewClicked: function() {
			$("#event_create").eventCreate("newEvent");
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
			$("#event_create").eventCreate("showEvent", url);
			$("#event_list").hide();
			$("#event_create").show();
		}
	});
	
	$("#event_show").eventCreate({
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
		ondeleteClicked: function(ID) {
			alert("ID: " + ID.ID);
			$("#delete-dialog").deleteDialog("open", ID);
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
	
	$("#delete-dialog").deleteDialog({
		oncanceld: function() {
		alert("gelöscht");
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