// Store zur Verwaltung von Modell-Klassen
Ext.define('PickIt.store.EventSubItemStore', {
	extend: 'Ext.data.Store',
	config: {
		
		
		// Hier muss der Name der Klasse vollst�ndig, mit Namespace, angegeben
		// werden, weil "ist halt einfach so".
		model: 'PickIt.model.EventSubItemModel',
		// Der Proxy f�hrt standardm��ig bei der Instantiierung keine WebService-
		// Anfrage durch. Mit autoload wird dies aktiviert.
		autoLoad: false
	}
});