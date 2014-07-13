$(function() {
	$(document).ajaxError(function(event, request) {
		// if (request.status == "404") {
			// $("#error-dialog").errorDialog("open", "Der webservice ist derzeit nicht erreichbar. Bitte versuchen Sie es zu einem späteren Zeitpunkt erneut.");
			// $("#content").show();
			// $("#event_list").hide();
		// };
	});
	
	$(document).ajaxStart(function() {
		$.blockUI({message:null});
	});
	$(document).ajaxStop(function() {
		$.unblockUI({message:null});
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
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	$("#search").menuSearch({
		onsearchClicked: function() {
			$("#event_create").hide();
			$("#event_show").hide();
			$("#content").hide();
			$("#event_list").show().eventList("search");
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	$("#event_list").eventList({
		oneventClicked: function(event, url) {
			$("#event_list").hide();
			$("#event_create").show();
			$("#event_create").eventCreate("showEvent", url);
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
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
		onsaveClicked: function(event, obj) {
			if (obj.element.find(".event-id").text() != "") {
			// alert(obj.element.find(".event-id").text());
			$("#save-dialog").saveDialog("open", obj);
			}
		},
		ondeleteClicked: function(event, eventId) {
			$("#delete-dialog").deleteDialog("open", eventId);
		},
		oncancelClicked: function() {
			$("#cancel-dialog").cancelDialog("open");
		},
		oneventSaved: function() {
			// alert("gespeichert!");
			// $("#event_show").eventDetails(url);
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	$("#cancel-dialog").cancelDialog({
		oncanceld: function() {
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		}
	});
	
	$("#delete-dialog").deleteDialog({
		ondeleted: function() {
			alert("gelöscht");
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	$("#save-dialog").saveDialog();
	
	$("#content").show();
	$("#event_show").hide();
	$("#event_create").hide();
	$("#event_list").hide();
	
		
});