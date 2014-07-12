$(function() {
	$(document).ajaxError(function(event, request) {
		$("#error_dialog").errorDialog("open", request.statusText);
		$("#event_details").hide();
		$("#event_list").show();	
		if (request.status == "404") {
			$("#event_list").eventList("reload");
		};
	});
	
	// $(document).ajaxStart(function() {
		// $.blockUI({message:null});
	// });
	// $(document).ajaxStop(function() {
		// $.unblockUI({message:null});
	// });
	
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
		},
		onsearchClicked: function() {
			alert("suche geklickt");
			$("#event_create").hide();
			$("#event_show").hide();
			$("#content").hide();
			$("#event_list").show().eventList("search");
		},
	});
	
	$("#search").menuSearch({
		onsearchClicked: function() {
			$("#event_create").hide();
			$("#event_show").hide();
			$("#content").hide();
			$("#event_list").show().eventList("search");
		}
	});
	
	$("#event_list").eventList({
		oneventClicked: function(event, url) {
			$("#event_list").hide();
			$("#event_create").show();
			$("#event_create").eventCreate("showEvent", url);
		}
	});
	
	// $("#event_show").eventCreate({
		// onsaveClicked: function() {
			// alert("speichern geklickt");
		// },
		// ondeleteClicked: function() {
			// alert("löschen geklickt");
		// }
	// });
	
	$("#event_create").eventCreate({
		onsaveClicked: function() {
		},
		ondeleteClicked: function(item, eventId) {
			alert("ID: " + eventId);
			$("#delete-dialog").deleteDialog("open", eventId);
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