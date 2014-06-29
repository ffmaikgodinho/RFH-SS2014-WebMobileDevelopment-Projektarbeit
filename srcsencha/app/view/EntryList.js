Ext.define('Eventliste.view.EntryList', {
	//extend: 'Ext.form.Panel',
	extend: 'Ext.dataview.List',
	xtype: 'entrylist',
	config: {
		store: 'Entries',
		itemTpl: '<div>{title} | {total_qty}</div>',
		// items:[ // Formularfelder in Arraystruktur
			// {
				// xtype: 'textfield',
				// name: 'title',
				// label: 'Titel',
				// readOnly: true
			// },
			
			// {
				// xtype: 'textfield',
				// name: 'total_qty',
				// label: 'Anzahl',
				// readOnly: true
			// },
			
			// {
				// xtype: 'textareafield',
				// name: 'note',
				// label: 'Notizen',
				// readOnly: true
			// }				
		// ]
	}
	
});
