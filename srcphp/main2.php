
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/desktop2.css">
		<title>Mainpage</title>
	</head>
	<body>
		<div id="outer-header">
			<div id="inner-header">
				<h1 id="logo">
					pick-it!
				</h1>
				<menu id="navigation">
					<a href=""><li id="navigation">About</li></a>
					<a href=""><li id="navigation">New</li></a>
					<a href=""><li id="navigation">Login</li></a>
				</menu>
				<form action="test.php" id="search" method="get">
					<input class="search" type="search" lang="de" name="search" placeholder="Search" maxlength="30"></>
					<input class="search" type="image" src="img/search.png" alt="Suche">
				</form>
			</div>
		</div>
		<!--<a href=""><img src="img/logo.gif" alt="logo" id="logo"></a>-->
		<div id="content-limiter">
			<div class="content-item">
				<div class="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div>
<!-- Ab hier addevent -->
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
<!-- Addevent ende -->			
<!-- Ab hier Additem -->
<?php 	
			$form_title = "Eintrag erstellen";
			
			if(isset($_GET["eventid"])){
				$q_eventid = $_GET["eventid"];
			} else {
				$q_eventid = 0;
			}
			
			// hidden form field if on edit mode
			$q_editmode = FALSE;
			
			// variables for form fields
			$q_title = "";
			$q_note = "";
			$q_link = "";
			$q_total_qty = "";
			
			// Read SQL Params if inUrl "?mode=edit"
			if(isset($_GET["mode"]) AND $_GET["mode"]=="edit") {
			
				// header on editmode
				$form_title = "Eintrag bearbeiten";
				
				// get entryid
				if(isset($_GET["id"])){
					$currentID = $_GET["id"];
				} else {
					$currentID = 0;
				}
				
				if(isset($_GET["eventid"])){
					$eventid = $_GET["eventid"];
				} else {
					$eventid = 0;
				}
				
				$query = "SELECT id, eventid, title, note, link, total_qty 
						  FROM entry 
						  WHERE id=$currentID";
						  
				//mysql_query($query);
				
				//debug  
				echo $query;
				
				// variables for form fields
				$q_id = $currentID;
				$q_title = "Title"; // ToDo: Get from query
				$q_note = "Notiz"; // ToDo: Get from query
				$q_link = "http://google.de"; // ToDo: Get from query
				$q_total_qty = "10"; // ToDo: Get from query
				$q_eventid = $eventid; // ToDo: Get from query
				$q_editmode = TRUE;
			}
			
			// Write input to database on submit
			 if(isset($_POST['submit'])) {
			  
			 	$id = $_POST["id"];
				$eventid = $_POST["eventid"];
				$title = $_POST["title"];
				$total_qty = $_POST["total_qty"];
				
				if (empty($_POST["note"])){
					$note = "";
				} else {
					$note = $_POST["note"];
				}
				
				if (empty($_POST["link"])){
					$link = "";
				} else {
					$link = $_POST["link"];
				}
				
				if($_POST["editmode"] == TRUE) {
				$query = "UPDATE entry 
						  SET eventid='$eventid', 
						      note='$note', 
						      link = '$link', 
						      total_qty = '$total_qty'
							WHERE id=$id";
				} else {
					$query = "INSERT INTO entry (eventid, note, link, total_qty)
									VALUES ('$eventid', '$note', '$link', '$total_qty')";
				}

				//debug
				echo $query;
				//mysql_query($query);
			 }


		?>
			<div class="content-item">
				<div class="content-head">
					<p class="content-title">
						<?php echo $form_title; ?>
					</p>
					<p class="content-creator">
					</p>
				</div>
				<div class="content-area">
					<div class="item">
						<form action="additem.php" method="post" class="item">
							<textarea rows="2" cols="30" name="note" class="item_note"><?php echo $q_note; ?></textarea>
							<div class="itembox-left">
								<input type="text" name="title" class="item_title" required="required" value="<?php echo $q_title; ?>" />
								<input type="number" name="total_qty" min="0" class="item_qty" value="<?php echo $q_total_qty; ?>" />
								<input type="hidden" name="id" value="<?php echo $q_id; ?>" />
								<input type="hidden" name="eventid" value="<?php echo $q_eventid; ?>" />
								<input type="hidden" name="editmode" value="<?php echo $q_editmode; ?>"/>
							</div>
<!--							<div class="submit-container">
								<input type="submit" name="submit" class="submit-button" value="Speichern">
							</div> -->
						</form>
						<div class="contribution">
							<input type="text" name="name" class="contribute_name" required="required" min="0" max="<?php echo $total_qty; ?>">
							<input type="number" name="quantity" class="contribute_qty" required="required" min="0" max="<?php echo $total_qty; ?>">
						</div>
					</div>
				</div>
				<div class="content-area">
					<div class="item">
						<form action="additem.php" method="post" class="item">
									<input type="text" name="title" class="item_title" required="required" value="<?php echo $q_title; ?>" />
									<input type="number" name="total_qty" min="0" class="item_qty" value="<?php echo $q_total_qty; ?>" />
								<textarea rows="2" cols="30" name="note" class="item_note"><?php echo $q_note; ?></textarea>
								<input type="hidden" name="id" value="<?php echo $q_id; ?>" />
								<input type="hidden" name="eventid" value="<?php echo $q_eventid; ?>" />
								<input type="hidden" name="editmode" value="<?php echo $q_editmode; ?>"/>
							</div>
<!--							<div class="submit-container">
								<input type="submit" name="submit" class="submit-button" value="Speichern">
							</div> -->
						</form>
						<div class="contribute">
						<input type="text" name="name" class="contribute_name" required="required" min="0" max="<?php echo $total_qty; ?>">
							<input type="number" name="quantity" class="contribute_qty" required="required" min="0" max="<?php echo $total_qty; ?>">
						</div>
					</div>
				</div>
				
			</div>
<!-- Additem ende -->
			<div class="content-item">
				<div id="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div><div class="content-item">
				<div id="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div><div class="content-item">
				<div id="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div><div class="content-item">
				<div id="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div><div class="content-item">
				<div id="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div><div class="content-item">
				<div id="content-head">
					<p class="content-title">
						Einladung zur Grillparty
					</p>
					<p class="content-creator">
						erstellt von d3nis
					</p>
				</div>
				<div class="content-area">
					blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent blacontent<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
					content2<br>
					content<br>
				</div>
			</div>
		<div id="footer">
			copyright 2014 bla bla blub | Impressum
		</div>
	</body>
</html>