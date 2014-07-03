Ext.define('PickIt.view.Main', {
    extend: 'Ext.navigation.View',
    xtype: 'mainView',
    requires: [
        'Ext.dataview.List'
    ],
    config: {
   
        items: [{
        	title: 'PickIt',
        	layout: 'card',
        	
        	items: [{
        		xtype: 'eventListView'
        	}]
        	
        }]
    }
});
