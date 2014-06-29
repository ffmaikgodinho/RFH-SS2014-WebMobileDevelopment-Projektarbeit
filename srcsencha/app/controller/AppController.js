// Steuert allgemeine (z.B. Zustandsänderungen, Events (Tap) in Views
Ext.define('Eventliste.controller.AppController', {
	extend: 'Ext.app.Controller',
	config: {
		control: {
			// reagiere auf ein Event des View Objekts 'todolist' 
			// (im xtype definiert) mit Funktion showTodoDetails
			eventlist: {
				itemtap: 'showEventEntries'
			}
		},
		// Angabe des Panels, wo das  das neue Panel erscheinen soll
		refs: {
			main: 'main'
		}
	},
	
	showEventEntries: function (list, index, target, record) {
		var main = this.getMain();
	
		// Lade den Store für die Einträge des aktuell geklickten Events
		var store = Ext.getStore('Entries');
		store.setProxy({
			url:'/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events/' + record.get('id'),
		});
		store.load();
		
		// Erzeuge ein neues, leeres Panel...
		var entrylist = Ext.widget('entrylist');
		// Übernimmt Werte des Records automatisch in entsprechende Feldnamen
		entrylist.setRecord(record); 
		
		// ...und werfe es auf einen Stack 
		// Ein Stack sind aufeinanderfolgende "Seiten", durch die durchnavigiert
		// werden kann. Mit main.push wird es hinten angefügt
		main.push(entrylist);
	}
});
