Ext.define('PickIt.view.EventSubItemsView', {
	
	extend: 'Ext.dataview.List',
	xtype: 'eventSubItemsView',
	
	requires: [
		'Ext.field.Spinner'
	],
	
	config: {
		store: 'EventSubItemStore',
		itemTpl: '<div><strong>{name}</strong><br /> <small>Menge: {quantity}</small></div>',
		disableSelection: true
	}
	
	/*
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
	
	}*/
	
	
	
});
