Ext.define('PickIt.controller.EventListDetailCtrl', {
	extend : 'Ext.app.Controller',

	config : {
		refs : {
			mainView : 'mainView',
			eventListDetailView : 'eventListDetailView'
		},
		control : {
			eventListDetailView : {
				itemtap : 'onItemTap'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function(app) {

		console.log('EventListDetailCtrl launched');

	},

	navigateTo : function(param) {

		console.log('gettin executed with param ' + param);
		
		
		Ext.getStore('EventDetailStore').removeAll();
		

		//TODO: add param to url
		Ext.Ajax.request({
			url : '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/' + param, // + '/' + param
			/*
			params : {
				id : param
			},
			*/
			success : function(response) {
				
				
				var data = Ext.JSON.decode(response.responseText.trim());
				
				//loop through entries
				Ext.Array.each(data.entrys, function(entry, index, entries){
					
					var eventDetail = Ext.create('PickIt.model.EventDetailModel', {
						id: entry.id,
					    title : entry.title,
					    note  : entry.note,
					    total_qty: entry.total_qty
					});
					
					
					Ext.getStore('EventDetailStore').add(eventDetail);
				
		
					
				});
				
				
				
			}
		});


	},
	
	onItemTap: function(list, index, target, record, e, eOpts){
		console.log(record);
		this.getApplication().getController('EventSubItemsCtrl').navigateTo(record.get('id'));
		this.getMainView().push({
			title: 'Form', 
			xtype: 'eventSubItemsView'}
		);
		
		
		
		
	}
	
	
	
	
});
