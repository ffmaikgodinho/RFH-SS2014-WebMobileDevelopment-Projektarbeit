
	function validateDate(that) {
		
		var dateElement = that.element.find("#date");
		
		if (dateElement.val() == "") {
			that.element.find("#empty-date").removeClass("template");
			dateElement.removeClass("event-formfield");
			dateElement.addClass("empty-required-field");
			dateElement.focus();
			return false;
		} else {
			var t = dateElement.val().split(/[- .]/);
			var d = new Date(t[2], t[1]-1, t[0]);
			
			if ((t[2]<0) || (t[2]>3000)) {
				d = "Invalid Date";
			};
			if ((t[1]-1<0) || (t[1]-1>12)) {
				d = "Invalid Date";
			};
			if ((t[0]<1) || (t[0]>31)) {
				d = "Invalid Date";
			};
			
			if (d == "Invalid Date") {
				valid = false;
				that.element.find("#no-date").removeClass("template");
				dateElement.removeClass("event-formfield");
				dateElement.addClass("empty-required-field");
				dateElement.focus();
				return false;
			};
			return true;
		};
	}
	
	function validateTime(that) {
		
		var timeElement = that.element.find("#time");
		
		if (timeElement.val() != "") {
			var t = timeElement.val().split(/[- :]/);
			var d = new Date(0,0,0,t[0], t[1], 0);
			
			if ((t[0]<0) || (t[0]>23)) {
				d = "Invalid Date";
			};
			if ((t[1]<0) || (t[1]>59)) {
				d = "Invalid Date";
			};
			if (d == "Invalid Date") {
				valid = false;
				that.element.find("#no-time").removeClass("template");
				timeElement.removeClass("event-formfield");
				timeElement.addClass("empty-required-field");
				timeElement.focus();
				return false;
			};
			return true;
		};
	}
	
	
	function validateTitle(that) {
		
		var titleElement = that.element.find("#title");
	
		if (titleElement.val() == "") {
			that.element.find("#empty-title").removeClass("template");
			titleElement.removeClass("event-formfield");
			titleElement.addClass("empty-required-field");
			titleElement.focus();
			return false;
		} else {
			return true;
		};
	}
	
	function validateLocation(that) {
		
		var locationElement = that.element.find("#location");
	
		if (locationElement.val() == "") {
			that.element.find("#empty-location").removeClass("template");
			locationElement.removeClass("event-formfield");
			locationElement.addClass("empty-required-field");
			locationElement.focus();
			return false;
		} else {
			return true;
		};
	}