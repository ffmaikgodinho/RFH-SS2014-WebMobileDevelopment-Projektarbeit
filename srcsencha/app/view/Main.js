Ext.define('PickIt.view.Main', {
	extend : 'Ext.navigation.View',
	xtype : 'mainView',
	requires : [
		'Ext.dataview.List'
	],
	config : {

		// title cannot be specified, because it's taken from the views
		navigationBar : {
			items : [{
					xtype: 'button',
					iconCls : 'add',
					align : 'right',
					id: 'addButton' // id reference to identify exactly this button in controller class
				},
			]
		},

		// Contentbereich
		items :
		[{
				title : 'PickIt',
				layout : 'card',

				items : [{
						xtype : 'eventListView'
					}
				]
			}
		]
	}
});
