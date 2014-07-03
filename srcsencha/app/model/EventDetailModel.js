Ext.define('PickIt.model.EventDetailModel', {
    extend: 'Ext.data.Model',
    
    config: {
		fields: [
			{
				name: 'id'
			},
			{
				name: 'title'
			},
			{
				name: 'note'
			},
			{
				name: 'total_qty'
			}
		]
    }
});
