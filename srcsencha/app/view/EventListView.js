Ext.define('PickIt.view.EventListView', {
	
	extend: 'Ext.dataview.List',
	xtype: 'eventListView',
	
	config: {
		
	
		
		store: 'EventsStore',
		itemTpl: '<div>Wo: {location} <br /> Wann: {date:date("d.m.Y")}</div>',
		disableSelection: true
		
		
	}
	
	
	
});
