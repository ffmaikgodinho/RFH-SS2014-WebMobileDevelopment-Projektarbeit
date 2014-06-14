<!DOCTYPE HTML> 
<html>
	<head>
		<title>Event erstellen</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/desktop2.css">
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	</head>
	<body> 
		<?php 	
			$form_title = "Event erstellen";
			
			// hidden form field if on edit mode
			$q_editmode = FALSE;
			
			// variables for form fields
			$q_title = "";
			$q_date = "";
			$q_time = "";
			$q_location = "";
			$q_desc = "";
			$q_type = "";
				
			// Read SQL Params if inUrl "?mode=edit"
			if(isset($_GET["mode"]) AND $_GET["mode"]=="edit") {
			
				// header on editmode
				$form_title = "Event bearbeiten";
				
				if(isset($_GET["id"])){
					$currentID = $_GET["id"];
				} else {
					$currentID = 0;
				}
				
				$query = "SELECT id, date, location, description, type 
						  FROM event 
						  WHERE id=$currentID";
						  
				//mysql_query($query);	
				
				//debug  
				echo $query;
				
				// variables for form fields
				$q_id = $currentID; 
				$q_title = "Title"; // ToDo: Get from query
				$q_datetime = new DateTime("1970-01-01 00:00:00"); // ToDo: Get from query
				$q_date = $q_datetime->format('m/j/Y');
				$q_time = $q_datetime->format('H:i');
				$q_location = "Location"; // ToDo: Get from query
				$q_desc = "Beschreibung";  // ToDo: Get from query	
				$q_type = 1;  // ToDo: Get from query	
				$q_editmode = TRUE;
			}
			
			// Write input to database on submit
			 if(isset($_POST['submit'])) { 
			 
				$title = $_POST["title"];
				$id = $_POST["id"];
				
				if (empty($_POST["date"])){
					$date = "";
				} else {
					$date = $_POST["date"];
				}
				
				if (empty($_POST["time"])){
					$time = "";
				} else {
					$time = $_POST["time"];
				}
				
				// $date und $time zusammenfuehren, da nur ein Feld in der Datenbank existiert
				$datetime = $date." ".$time;
				
				if (empty($_POST["desc"])){
					$desc = "";
				} else {
					$desc = $_POST["desc"];
				}
				
				if (empty($_POST["location"])){
					$location = "";
				} else {
					$location = $_POST["location"];
				}
				
				if (empty($_POST["type"])){
					$type = "";
				} else {
					$type = $_POST["type"];
				}
				
				if($_POST["editmode"] == TRUE) {
				$query = "UPDATE event 
						  SET date='$datetime', 
						      location='$location', 
						      description = '$desc', 
						      type = '$type'
							WHERE eventid=$id";
				} else {
				$query = "INSERT INTO event (date, location, description, type)
									VALUES ('$datetime', '$location', '$desc', '$type')";
				}
				//debug
				echo $query;
				//mysql_query($query);
			 }


		?>
		<div id="content-limiter">
			<div class="content-item">
				<form action="addevent.php" method="post" class="form-container">
					<div class="content-head">
						<p class="content-title">
							<?php echo $form_title; ?>
						</p>
						<p class="content-creator">
						</p>
					</div>
					<div class="content-area">
						<div class="form-title">
							Titel*: 
						</div> 
						<input type="text" name="title" class="form-field" required="required" value="<?php echo $q_title; ?>" />
						<br />
						<div class="form-title">
							Veranstaltungsdatum: 
						</div> 
						<input type="date" name="date" value="<?php echo $q_date; ?>" />
						<br />
						<div class="form-title">
							Beginn: 
						</div> 
						<input type="time" name="time" value="<?php echo $q_time; ?>" />
						<br />
						<div class="form-title">
							Ort: 
						</div> 
						<input type="text" name="location" value="<?php echo $q_location; ?>" />
						<br />
						<div class="form-title">
							Beschreibung: 
						</div> 
						<textarea rows="4" cols="50" name="desc" class="form-field"><?php echo $q_desc; ?></textarea>
						<br />
						<div class="form-title">
							Eventtyp: 
						</div> 
						<input type="radio" name="type" value="1" <?php if($q_type == 1) echo "checked"; ?>>Wunschliste<br />
						<input type="radio" name="type" value="2" <?php if($q_type == 2) echo "checked"; ?>>Essen und Trinken<br />
						<input type="hidden" name="id" value="<?php echo $q_id; ?>"/>
						<input type="hidden" name="editmode" value="<?php echo $q_editmode; ?>"/>
						<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Speichern">
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
