Ext.define('PickIt.view.EventListDetailView', {
	
	extend: 'Ext.dataview.List',
	xtype: 'eventListDetailView',
	
	config: {
		
		store: 'EventDetailStore',
		itemTpl: '<div>Note: {note} <br /> Title: {title}</div>',
		disableSelection: true
	}
	
	
	
});
