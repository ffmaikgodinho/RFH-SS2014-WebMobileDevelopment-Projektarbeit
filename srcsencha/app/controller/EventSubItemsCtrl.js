Ext.define('PickIt.controller.EventSubItemsCtrl', {
	extend : 'Ext.app.Controller',
	
	config : {
		refs : {
			mainView : 'mainView',
			
			eventSubItemsView : 'eventSubItemsView',
			
			saveBtn : '#saveBtn'
			
		},
		control : {
			saveBtn:{
				tap: 'onTapSaveBtn'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function(app) {

		console.log('EventSubItemsCtrl launched'); // debug

	},

	navigateTo : function(param) {

		console.log('gettin executed with param ' + param); // debug
		
		
		// var saveBtn = this.getMainView().getNavigationBar().add({
			// xtype: 'button',
			// html: 'save',
			// align: 'right'
		// });
		
		
		
		Ext.Ajax.request({
			url : '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/evententries/' + param,
			scope : this,
			
			/*
			params : {
				id : param
			},
			*/
			success : function(response) {
				
				
				var data = Ext.JSON.decode(response.responseText.trim());
				
				var that = this;
				
				//loop through entries
				Ext.Array.each(data.contributions, function(entry, index, entries){
					
					var subItem = Ext.create('PickIt.model.EventSubItemModel', {
						id : entry.id,
					    userid : entry.userid,
					    name  : entry.name,
					    quantity: entry.quantity
					});
					
					that.getEventSubItemsView().setRecord(subItem);
					
				});
				
				
				
			}
			
		});
		

	},
	
	onTapSaveBtn : function(saveBtn, e, eOpts){
		
		var model = this.getEventSubItemsView().getRecord();
		
		Ext.Ajax.request({
			url : '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/eventContributions/' + model.data.id,
			scope : this,
			method: 'PUT',
			
			jsonData : Ext.JSON.encode(model.data)
			
		});
		
		this.getMainView().pop();
		
	}
	
	
});
