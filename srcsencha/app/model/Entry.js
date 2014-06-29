// Modell für einen Eintrag zu einem Event
Ext.define('Eventliste.model.Entry', {
	extend: 'Ext.data.Model',
	config: {
		// Felder, die in der Detailansicht dargestellt werden. Der Name ist 
		// mit denen aus dem Webservice identisch.
		fields: [
			{
				name: 'title'
			},
			{
				name: 'note'
			},
			{
				name: 'total_qty'
			},
		]
	}
});
