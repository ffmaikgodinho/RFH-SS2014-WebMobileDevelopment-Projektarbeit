// Store zur Verwaltung von Modell-Klassen
Ext.define('PickIt.store.EventSubItemStore', {
	extend: 'Ext.data.Store',
	config: {
		
		// HTTP Proxy, der die Daten direkt vom WebService abfragt
		proxy: {
			type: 'rest',
			url: '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/eventContributions',
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
		// Hier muss der Name der Klasse vollst�ndig, mit Namespace, angegeben
		// werden, weil "ist halt einfach so".
		model: 'PickIt.model.EventSubItemModel',
		// Der Proxy f�hrt standardm��ig bei der Instantiierung keine WebService-
		// Anfrage durch. Mit autoload wird dies aktiviert.
		autoLoad: false
	}
});