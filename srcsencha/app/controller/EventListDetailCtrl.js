Ext.define('PickIt.controller.EventListDetailCtrl', {
	extend : 'Ext.app.Controller',

	config : {
		refs : {
			mainView : 'mainView',
			eventListDetailView : 'eventListDetailView'
		},
		control : {
			eventListDetailView : {
				itemsingletap : 'onItemSingleTap'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function (app) {

		console.log('EventListDetailCtrl launched'); // debug
	},

	navigateTo : function (param) {

		console.log('gettin executed with param ' + param); // debug
		Ext.getStore('EventDetailStore').removeAll();

		Ext.Ajax.request({
			url : '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/' + param,
			success : function (response) {

				var data = Ext.JSON.decode(response.responseText.trim());

				//loop through entries
				Ext.Array.each(data.entrys, function (entry, index, entries) {

					var eventDetail = Ext.create('PickIt.model.EventDetailModel', {
							id : entry.id,
							title : entry.title,
							note : entry.note,
							total_qty : entry.total_qty
						});
					Ext.getStore('EventDetailStore').add(eventDetail);
				});

				// add new button?

			}
		});

	},

	onItemSingleTap : function (list, index, target, record, e, eOpts) {

		this.getApplication().getController('EventSubItemsCtrl').navigateTo(record.get('id'));

		this.getMainView().push({
			title : record.get('title'),
			xtype : 'eventSubItemsView'
		});

	}

});
