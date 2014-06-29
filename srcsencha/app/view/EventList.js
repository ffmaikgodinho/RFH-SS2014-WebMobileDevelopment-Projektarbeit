// Hier sollen alle Events angezeigt werden. Hierfür wird eine bereits existierende
// Klasse Ext.dataviewList verwendet.
Ext.define('Eventliste.view.EventList', {
	extend: 'Ext.dataview.List',
	xtype: 'eventlist', // identifier für Konfiguration in der Main.js
	config: {
		// Die Daten aus dem Store Todos werden hier verwendet. Dies 
		// wird im Hintergrund durch das Sencha-Framework gesteuert.
		store: 'Events',
		// Das Template, wie jeder Eintrag des Stores angezeigt wird. 
		// Mit location kann das im Store definierte Feld direkt 
		// angesprochen werden.
		itemTpl: '<div>Wo: {location} <br /> Wann: {date:date("d.m.Y")}</div>',
		
		emptyText: 'Es konnten keine Events gefunden werden.'
	}
});
