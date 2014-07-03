// Store zur Verwaltung von Modell-Klassen
Ext.define('PickIt.store.EventsStore', {
	extend: 'Ext.data.Store',
	config: {
		// HTTP Proxy, der die Daten direkt vom WebService abfragt
		
		/*
		proxy: {
			type: 'rest',
			url: '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events',
			reader: {
				type: 'json' // R�ckgabeewert soll json sein
			},
			//registriert Funktionen f�r bestimmte Ereignisse
			listeners: {
				// im Fehlerfall
				exception: function(proxy, request) {
					Ext.Msg.alert(request.statusText);
				}
			}
		},
		*/
		
		proxy: {
	        type: "ajax",
	        url : "/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events",
	        reader: {
	            type: "json"
	        }
	    },
		
		
		// Hier muss der Name der Klasse vollst�ndig, mit Namespace, angegeben
		// werden, weil "ist halt einfach so".
		model: 'PickIt.model.EventModel',
		// Der Proxy f�hrt standardm��ig bei der Instantiierung keine WebService-
		// Anfrage durch. Mit autoload wird dies aktiviert.
		autoLoad: false
	}
});