// Store zur Verwaltung von Modell-Klassen
Ext.define('Eventliste.store.Events', {
	extend: 'Ext.data.Store',
	config: {
		// HTTP Proxy, der die Daten direkt vom WebService abfragt
		proxy: {
			type: 'rest',
			url: '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events',
			reader: {
				type: 'json' // Rückgabeewert soll json sein
			},
			//registriert Funktionen für bestimmte Ereignisse
			listeners: {
				// im Fehlerfall
				exception: function(proxy, request) {
					Ext.Msg.alert(request.statusText);
				}
			}
		},
		
		// Hier muss der Name der Klasse vollständig, mit Namespace, angegeben
		// werden, weil "ist halt einfach so".
		model: 'Eventliste.model.Event',
		// Der Proxy führt standardmäßig bei der Instantiierung keine WebService-
		// Anfrage durch. Mit autoload wird dies aktiviert.
		autoLoad: true
	}
});
