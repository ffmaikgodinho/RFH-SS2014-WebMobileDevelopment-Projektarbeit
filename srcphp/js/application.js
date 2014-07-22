// Application
// Autor: Denis Kündgen

$(function() {
	
	//allgemeine Fehlerbehandlung
	$(document).ajaxError(function(event, request) {
		if (request.status == "400") {
				return;
			};
		if (request.status == "404") {
			$("#error-dialog").errorDialog("open", "Der Webservice steht derzeit nicht zur Verfügung, bitte versuchen Sie es zu einem späteren Zeitpunkt erneut.");
		} else {
			$("#error-dialog").errorDialog("open", request.statusText);
		};
		$("#login").hide();
		$("#event_create").hide();
		$("#event_list").hide();
		$("#event_show").hide();
		$("#content").show();
	});
	
	// Blocken der UI beim Verarbeiten
	$(document).ajaxStart(function() {
		$.blockUI({message:null});
	});
	$(document).ajaxStop(function() {
		$.unblockUI({message:null});
	});
	
	// Error-Dialog
	$("#error-dialog").errorDialog();
	
	// Logo-Bereich
	// mit Klick auf das Logo öffnet sich die Liste aller Events
	$("#logo-space").menuBar({
		onlogoClicked: function() {
			$("#login").hide();
			$("#event_create").hide();
			$("#event_show").hide();
			$("#content").hide();
			$("#event_list").show().eventList("search", "", "");
		}
	});
	
	// Menuleiste
	$("#navigation").menuBar({
		onaboutClicked: function() {
			$("#login").hide();
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		},
		onnewClicked: function() {
			$("#login").hide();
			$("#event_create").eventCreate("newEvent");
			$("#event_create").show();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").hide();
		},
		onloginClicked: function() {
			$("#login").show();
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").hide();
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	// Suchfunktion
	$("#search").menuSearch({
		onsearchClicked: function() {
			var searchString = $("#search_string").val();
			$("#login").hide();
			$("#event_create").hide();
			$("#event_show").hide();
			$("#content").hide();
			$("#event_list").show().eventList("search", searchString, "");
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	// Eventliste
	$("#event_list").eventList({
		oneventClicked: function(event, url) {
			$("#content").hide();
			$("#login").hide();
			$("#event_list").hide();
			$("#event_create").show();
			$("#event_create").eventCreate("showEvent", url);
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	// Event anzeigen/editieren/löschen/speichern sowie die dazugehörigen Einträge (entries)
	$("#event_create").eventCreate({
		onsaveClicked: function(event, obj) {
			if (obj.element.find(".event-id").text() != "") {
			$("#save-dialog").saveDialog("open", obj);
			}
		},
		ondeleteClicked: function(event, eventId) {
			$("#delete-dialog").deleteDialog("open", eventId);
		},
		oncancelClicked: function() {
			$("#cancel-dialog").cancelDialog("open");
		},
		onerror: function(error, message) {
			$("#error-dialog").errorDialog("open", message);
		}
	});
	
	// Dialog zum Abbrechen von Eingaben
	$("#cancel-dialog").cancelDialog({
		oncanceld: function() {
			$("#login").hide();
			$("#event_create").hide();
			$("#event_list").hide();
			$("#event_show").hide();
			$("#content").show();
		}
	});
	
	// Dialog zum Bestätigen vor der Löschung eines Events
	$("#delete-dialog").deleteDialog({
		ondeleted: function() {
			$("#login").hide();
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
	
	// Content-Anzeige beim Start der Applikation
	$("#content").show();
	$("#event_show").hide();
	$("#event_create").hide();
	$("#event_list").hide();
	$("#login").hide();
	
		
});