// Store zur Verwaltung von Modell-Klassen
Ext.define('PickIt.store.EventsStore', {
	extend: 'Ext.data.Store',
	config: {

		
		// Hier muss der Name der Klasse vollständig, mit Namespace, angegeben
		// werden, weil "ist halt einfach so".
		model: 'PickIt.model.EventModel',
		// Der Proxy führt standardmäßig bei der Instantiierung keine WebService-
		// Anfrage durch. Mit autoload wird dies aktiviert. In diesem Fall deaktiviert,
		// da dieses nur bei Bedarf im Controller erfolgt.
		autoLoad: false
	}
});