Ext.define('PickIt.controller.EventListCtrl', {
	extend : 'Ext.app.Controller',
	
	config : {
		refs : {
			
			mainView : 'mainView',
			
			eventListView : 'eventListView',
			eventListDetailView : 'eventListDetailView'
			
		},
		control : {
			eventListView: {
				itemtap : 'onItemTap'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function(app) {
		
		console.log('EventListCtrl launched');
		
		Ext.getStore('EventsStore').load({
			callback : function(records, operation, success) {
				// the operation object contains all of the details of the load operation
				console.log(records);
			},
			scope : this
		});
		
		

	},
	
	onItemTap: function(list, index, target, record, e, eOpts){
		
		this.getApplication().getController('EventListDetailCtrl').navigateTo(record.get('id'));
		this.getMainView().push({
			title: record.get('location'), 
			xtype: 'eventListDetailView'}
		);
		
	}
	
	
});
