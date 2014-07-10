Ext.define('PickIt.controller.MainCtrl', {
	extend : 'Ext.app.Controller',
	
	config : {
		refs : {
			mainView : 'mainView',
			addButton: '#addButton'
		},
		control : {
			mainView:{
				back : 'onBack'
			},
			addButton: {
				tap: 'onButtonTap'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function(app) {
		console.log('MainCtrl launched'); //debug
	},

	onBack : function(view, eOpts){
		// destroys view when clicked on back button to ensure proper references
		this.getMainView().pop(view);
	},
	
	onButtonTap: function(button, e, eOpts){
		console.log('addButton tap not implemented');
		
		/*
		this.getMainView().getActiveItem().id
		var item = Ext.create('<model>',{<field>:<value>};
		var store = Ext.getStore('<store>);
		store.add(item);
		store.sync();
	 */
	}
});
