<!DOCTYPE HTML> 
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/desktop2.css">
		<title>Eintrag anlegen</title>
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	</head>
	<body> 
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
		<div id="content-limiter">
			<div class="content-item">
				<form action="additem.php" method="post" class="form-container">
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
							Menge: 
						</div> 
						<input type="number" name="total_qty" min="0" value="<?php echo $q_total_qty; ?>" />
						<br />
						<div class="form-title">
							Link: 
						</div> 
						<input type="url" name="link" value="<?php echo $q_link; ?>" />
						<br />
						<div class="form-title">
							Notiz: 
						</div> 
						<textarea rows="4" cols="50" name="note" class="form-field"><?php echo $q_note; ?></textarea>
						<br />

						<input type="hidden" name="id" value="<?php echo $q_id; ?>" />
						<input type="hidden" name="eventid" value="<?php echo $q_eventid; ?>" />
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
