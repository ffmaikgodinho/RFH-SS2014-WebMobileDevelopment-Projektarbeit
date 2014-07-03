Ext.define('PickIt.controller.MainCtrl', {
	extend : 'Ext.app.Controller',
	
	config : {
		refs : {
			mainView : 'mainView'
		},
		control : {
			mainView:{
				back : 'onBack'
			}
		}
	},

	
	//called when the Application is launched, remove if not needed
	launch : function(app) {

		console.log('MainCtrl launched');

	},

	onBack : function(view, eOpts){
		
		//this.getMainView().pop();
		this.getMainView().pop(view);
		
		
	}
		

});
