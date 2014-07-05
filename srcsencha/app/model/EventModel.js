Ext.define('PickIt.model.EventModel', {
    extend: 'Ext.data.Model',
    
    config: {
        fields: [
			{
				name: 'id',
				type: 'string'
			},
			{
				name: 'add_date',
				type: 'date'
			},
			{
				name: 'date',
				type: 'date'
			},
			{
				name: 'title',
				type: 'string'
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
			},
			{
				name: 'stamp',
				type: 'string'
			}
		]
    }
});
