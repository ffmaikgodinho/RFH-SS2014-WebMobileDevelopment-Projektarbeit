Ext.define('PickIt.view.EventListView', {
	
	extend: 'Ext.dataview.List',
	xtype: 'eventListView',
	
	config: {
		store: 'EventsStore',
		itemTpl: '<div><strong>{title}</strong><br /> <small>Ort: {location} <br />Datum: {date:date("d.m.Y")}</small></div>',
		disableSelection: true
	}
});
