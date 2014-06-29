// Store zur Verwaltung von Modell-Klassen
// ToDo: Pr�fen, ob Store Entries mit Store Events zusammengefasst werden kann.
Ext.define('Eventliste.store.Entries', {
	extend: 'Ext.data.Store',
	config: {
		// HTTP Proxy, der die Daten direkt vom WebService abfragt
		proxy: {
			type: 'rest',
			url: '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events',
			reader: {
				type: 'json', // R�ckgabewert soll json sein
				rootProperty: 'entrys' // Nur die Objekte unter 'entrys' zur�ckgeben
			},
			//registriert Funktionen f�r bestimmte Ereignisse
			listeners: {
				// im Fehlerfall
				exception: function(proxy, request) {
					Ext.Msg.alert(request.statusText);
				}
			}
		},
		
		// Hier muss der Name der Klasse vollst�ndig, mit Namespace, angegeben
		// werden, weil "ist halt einfach so".
		model: 'Eventliste.model.Entry'
		// Der Proxy f�hrt standardm��ig bei der Instantiierung keine WebService-
		// Anfrage durch. Mit autoload wird dies aktiviert.
		//autoLoad: true
	}
});
