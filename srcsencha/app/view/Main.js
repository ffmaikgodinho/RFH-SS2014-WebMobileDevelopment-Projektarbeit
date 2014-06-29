Ext.define('Eventliste.view.Main', {
	// Von Klasse Ext.Panel ableiten
	// Ein Panel bildet einen Rahmen - quasi das Hauptfenster - für 
	// verschiedene Objekte (z.B. TodoList)
	extend: 'Ext.navigation.View',
	xtype: 'main',
	config: {
		items: {
			xtype: 'eventlist' // Einbinden der ToDoList
		},
		// Layout 'fit' gibt an, dass der gesamte Platz in dem Panel 
		// genutzt werden kann. Sonst wird hier nix angezeigt!
		// layout 'card' muss bei navigation View genutzt werden.
		//layout: 'card' 
	
	defaultBackButtonText: 'zurück'
	
	}
	
});
