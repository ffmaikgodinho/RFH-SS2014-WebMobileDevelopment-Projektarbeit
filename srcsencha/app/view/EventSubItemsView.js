Ext.define('PickIt.view.EventSubItemsView', {
	
	extend: 'Ext.form.Panel',
	xtype: 'eventSubItemsView',
	id: 'eventSubItemsView',
	
	requires: [
		'Ext.field.Spinner'
	],
	
	config: {
		
		items:[{
			xtype: 'textfield',
			name: 'name',
			label: 'Name'
		},{
			xtype: 'spinnerfield',
			name: 'quantity',
			label: 'Anzahl',
			
			
			minValue: 0,
			maxValue: 5,
			stepValue: 1
			
			
		},{
			xtype: 'button',
			text: 'save',
			id: 'saveBtn'
		}]
	
	}
	
	
	
});
