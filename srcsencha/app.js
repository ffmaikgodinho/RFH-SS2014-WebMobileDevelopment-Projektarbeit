// DO NOT DELETE - this directive is required for Sencha Cmd packages to work.
//@require @packageOverrides

//<debug>
Ext.Loader.setPath({
    "Ext": "touch/src"
});
//</debug>

Ext.application({
    name: "Eventliste",

    requires: [
      "Ext.MessageBox",
	  "Ext.data.proxy.Rest"
    ],
    
    views: [
		// Hier hinzugef�gte Eintr�ge sind vergleichbar mit der Referenzierung in der index.html
		// (<script src="...">)
        "Main",
		"EventList", // aus der Zeile -> Ext.define('Todoliste.view.TodoList' in der TodoList.js
		"EntryList"
    ],
	
	stores: [
		"Events",
		"Entries"
	],
	
	models: [
		"Event",
		"Entry"
	],
	
	controllers: [
		"AppController"
	],

    icon: {
        "57": "resources/icons/Icon.png",
        "72": "resources/icons/Icon~ipad.png",
        "114": "resources/icons/Icon@2x.png",
        "144": "resources/icons/Icon~ipad@2x.png"
    },

    isIconPrecomposed: true,

    startupImage: {
        "320x460": "resources/startup/320x460.jpg",
        "640x920": "resources/startup/640x920.png",
        "768x1004": "resources/startup/768x1004.png",
        "748x1024": "resources/startup/748x1024.png",
        "1536x2008": "resources/startup/1536x2008.png",
        "1496x2048": "resources/startup/1496x2048.png"
    },

    launch: function() {
        // Destroy the #appLoadingIndicator element
        Ext.fly("appLoadingIndicator").destroy();

        // Initialize the main view
        Ext.Viewport.add(Ext.create("Eventliste.view.Main"));
    },

    onUpdated: function() {
        Ext.Msg.confirm(
            "Application Update",
            "This application has just successfully been updated to the latest version. Reload now?",
            function(buttonId) {
                if (buttonId === "yes") {
                    window.location.reload();
                }
            }
        );
    }
});
