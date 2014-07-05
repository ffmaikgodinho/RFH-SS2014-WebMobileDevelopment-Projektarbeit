Ext.define('PickIt.controller.EventListCtrl', {
	extend : 'Ext.app.Controller',

	config : {
		refs : {
			mainView : 'mainView',
			eventListView : 'eventListView',
			eventListForm : 'eventListForm',
			eventListDetailView : 'eventListDetailView'
		},
		control : {
			eventListView : {
				itemsingletap : 'onItemSingleTap',
				itemdoubletap : 'onItemDoubleTap',
				itemswipe : 'onItemSwipe'
			}
		}
	},

	//called when the Application is launched, remove if not needed
	launch : function (app) {

		console.log('EventListCtrl launched'); // debug

		Ext.getStore('EventsStore').load({
			callback : function (records, operation, success) {
				// the operation object contains all of the details of the load operation
				console.log(records); //debug
			},
			scope : this
		});

	},

	onItemSingleTap : function (list, index, target, record, e, eOpts) {
		// call navigateTo event on subitem, which loads content for selected id
		this.getApplication().getController('EventListDetailCtrl').navigateTo(record.get('id'));

		// push list of subitems on MainView
		this.getMainView().push({
			title : record.get('title'),
			xtype : 'eventListDetailView'
		});
	},

	// open edit/details view
	onItemDoubleTap : function (list, index, target, record, e, eOpts) {

		console.log('Double Tap');

		var eventform = Ext.widget('eventListForm');
		eventform.setRecord(record);
		this.getMainView().add(eventform);
		//eventform.show();
		//main.push(eventform);


		//this.getEventListForm().setRecord(record);

		//this.getMainView().push({
		//	title: record.get('title'),
		//	xtype: 'eventListForm'
		//});
	},

	// open confirm window and delete current item when clicked on 'yes'
	// do nothing when clicked on 'no'
	onItemSwipe : function (list, index, target, record, e, eOpts) {
		Ext.Msg.confirm('Löschen', 'Möchten Sie den Eintrag ' + record.get('title') + ' wirklich löschen?', function (e) {
			if (e == 'yes') {
				// deleteitem
				Ext.Ajax.request({
					url : '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/' + record.get('id'),
					scope : this,
					method : 'DELETE',
					success: function () {
						// reload
						list.reset();
						Ext.getStore('EventsStore').load();
					}
				});
			}
		})
	}
});
