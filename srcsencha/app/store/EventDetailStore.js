// Store zur Verwaltung von Modell-Klassen
Ext.define('PickIt.store.EventDetailStore', {
	extend: 'Ext.data.Store',
	config: {
		model: 'PickIt.model.EventDetailModel',
		autoLoad: false
	}
});