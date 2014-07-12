Ext.define('PickIt.controller.MainCtrl', {
	extend : 'Ext.app.Controller',

	config : {
		refs : {
			mainView : 'mainView',
			addButton : '#addButton'
		},
		control : {
			mainView : {
				back : 'onBack'
			},
			addButton : {
				tap : 'onButtonTap'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function (app) {
		console.log('MainCtrl launched'); //debug
	},

	onBack : function (view, eOpts) {
		// destroys view when clicked on back button to ensure proper references
		this.getMainView().pop(view);
	},

	onButtonTap : function (button, e, eOpts) {
		console.log(this.getMainView().getActiveItem().id);
		if (this.getMainView().getActiveItem().id == 'ext-container-1') {
			var eventform = Ext.widget('eventListForm');
			this.getMainView().add(eventform);
		} else {
			console.log('AddItem not implemented for this list');
		}
		// ext-container-1  (main View)
		// ext-eventListDetailView-1 
		// ext-eventSubItemsView-1 
		
		/*
		var item = Ext.create('<model>',{<field>:<value>};
		var store = Ext.getStore('<store>);
		store.add(item);
		store.sync();
		 */
	}
});