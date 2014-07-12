Ext.define('PickIt.view.EventListDetailView',
{
	extend : 'Ext.dataview.List',
	xtype : 'eventListDetailView',

	config :
	{
		store : 'EventDetailStore',
		itemTpl : '<div><strong>{title}</strong><br /><small>Gesamtmenge: {total_qty}</small></div>',
		disableSelection : true
	}
});
