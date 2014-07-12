Ext.define('PickIt.model.EventModel', {
	extend : 'Ext.data.Model',
		
	config : {
		// HTTP Proxy, der die Daten direkt vom WebService abfragt
		proxy : {
			type : 'rest',
			url : '/RFH-SS2014-WebMobileDevelopment-Projektarbeit/srcphp/api/events',
			reader : {
				type : 'json' // Rückgabeewert soll json sein
			},
			//registriert Funktionen für bestimmte Ereignisse
			listeners : {
				// im Fehlerfall
				exception : function (proxy, request) {
					Ext.Msg.alert(request.statusText);
				}
			}
		},
		fields : [{
				name : 'id'
			}, {
				name : 'date',
				type : 'date',
			}, {
				name : 'title',
				type : 'string'
			}, {
				name : 'location',
				type : 'string'
			}, {
				name : 'description',
				type : 'string'
			}, {
				name : 'type',
				type : 'string'
			}, {
				name : 'stamp',
				type : 'string'
			}
		]
	}
});
