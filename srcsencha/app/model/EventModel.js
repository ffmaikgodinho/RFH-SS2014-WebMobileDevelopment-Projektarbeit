Ext.define('PickIt.model.EventModel', {
    extend: 'Ext.data.Model',
    
    config: {
        fields: [
			{
				name: 'date',
				type: 'date'
			},
			{
				name: 'location',
				type: 'string'
			},
			{
				name: 'description',
				type: 'string'
			},
			{
				name: 'type',
				type: 'string'
			}
		]
    }
});
