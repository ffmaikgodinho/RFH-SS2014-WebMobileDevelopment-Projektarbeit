// Modell für ein Event
Ext.define('Eventliste.model.Event', {
	extend: 'Ext.data.Model',
	config: {
		// Feldname = Name im WebService
		fields: [
			{
				name: 'date',
				type: 'date'
			},
			{
				name: 'location'
			},
			{
				name: 'description'
			},
			{
				name: 'type'
			}
		]
	}
});
