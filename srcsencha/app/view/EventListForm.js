Ext.define('PickIt.view.EventListForm', {
	
	extend: 'Ext.form.Panel',
	xtype: 'eventListForm',
	requires: [
		'Ext.field.DatePicker'
	],
	
	config: {
		modal: true,
		items:
		[
		
			{
				xtype: 'textfield',
				name: 'id',
				label: 'ID',
				readOnly: true
			},
			
			/*
			{
				xtype: 'datepickerfield',
				name: 'add_date',
				label: 'Hinzugefügt',
				readOnly: true
			},
			*/
			{
				xtype: 'datepickerfield',
				name: 'date',
				label: 'Datum'
			},
			{
				xtype: 'textfield',
				name: 'title',
				label: 'Titel'
			},
			{
				xtype: 'textareafield',
				name: 'location',
				label: 'Ort'
			},
			{
				xtype: 'textareafield',
				name: 'description',
				label: 'Beschreibung'
			},
			{
				xtype: 'selectfield',
				name: 'type',
				label: 'Typ',
				options: [
					{
						text: 'Geschenke',
						value: 0
					},
					{
						text: 'Buffet',
						value: 1
					}
				]
			},
			
			{
				xtype: 'button',
				text: 'Speichern',
				id: 'eventListSave'
			}
		]
	}	
});
