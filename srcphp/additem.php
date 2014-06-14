<!DOCTYPE HTML> 
<html>
	<head>
		<title>Eintrag anlegen</title>
		<style type="text/css">
			.entry {}
			.entry-title { color: #44cccc; margin: 5px; }
			.entry-qty {margin: 5px;}
			.entry-note {margin: 5px;}
		</style>
		<script type="text/javascript">
			function showNewEntryForm() {
				document.getElementById('newEntry').style.visibility = "visible";
			}
		</script>
	</head>
	<body> 
		<?php 	
			if(isset($_GET["eventid"])){
				$q_eventid = $_GET["eventid"];
			} else {
				$q_eventid = 0;
			}
			
			// get entryid
			if(isset($_GET["id"])){
				$currentID = $_GET["id"];
			} else {
				$currentID = 0;
			}
			
			// Initialize form params
			if(isset($_GET["mode"])) {
				
				$query = "SELECT id, eventid, title, note, total_qty 
						  FROM entry 
						  WHERE id=$currentID";
						  
				//mysql_query($query);
			}
			
			// Write input to database on submit
			 if(isset($_POST['submit'])) {
			  
				if (isset($_POST["entryid"])) {
					$id = $_POST["entryid"];
				}
				
				$eventid = $_POST["eventid"];
				$title = $_POST["title"];
				$total_qty = $_POST["total_qty"];
				
				if (empty($_POST["note"])){
					$note = "";
				} else {
					$note = $_POST["note"];
				}
				
				if($_POST["mode"] == "update") {
				$query = "UPDATE entry 
						  SET eventid='$eventid', 
							  title='$title',
						      note='$note', 
						      total_qty = '$total_qty'
							WHERE id=$id";
				} else if ($_POST["mode"] == "new") {
					$query = "INSERT INTO entry (eventid, title, note, total_qty)
									VALUES ('$eventid', '$title', '$note', '$total_qty')";
				}

				//debug
				echo $query;
				//mysql_query($query);
			 }

			
		?>

		<!-- Show all Items -->
		<?php 
			// ToDo: $entries = get_allentrys()
			$entries = [[1, 1, "Brot", 2, ""],[2, 1, "Salat", 4, "Notiz"]];
			
			$userLoggedIn = TRUE;
			if($userLoggedIn) { 
				$disabled = "";
			} else {
				$disabled = "disabled";
			}
			
			foreach ($entries as list($entry_id, $event_id, $entry_title, $entry_qty, $entry_note)) {
				echo "<form action=\"additem.php\" method=\"post\" id=\"editEntry\" class=\"form-container\">";
				echo "<input type=\"text\" name=\"title\" class=\"form-field\" required=\"required\" value=\"".$entry_title."\" ".$disabled." />";
				echo "<input type=\"number\" name=\"total_qty\" min=\"0\" value=\"".$entry_qty."\" ".$disabled." />";
				echo "<textarea rows=\"2\" cols=\"50\" name=\"note\" class=\"form-field\" ".$disabled.">".$entry_note."</textarea>";
				
				echo "<input type=\"hidden\" name=\"eventid\" value=\"".$event_id."\"/>";
				echo "<input type=\"hidden\" name=\"entryid\" value=\"".$entry_id."\"/>";
				echo "<input type=\"hidden\" name=\"mode\" value=\"update\"/>";
				
				if ($userLoggedIn) {
					echo "<input type=\"submit\" name=\"submit\" class=\"submit-button\" value=\"Speichern\">";
				}
				echo "</form>";
			}
		?>
		
		<!-- New Item -->
		<?php
		
		$userIsAdmin = $userLoggedIn;
		if ($userIsAdmin) {
			echo "<img src=\"img\\new-icon.png\" onclick=\"javascript:showNewEntryForm()\">";
		}
		?>
		
		<div class="content-item" id="newEntry" style="visibility:hidden">
			<form action="additem.php" method="post" class="form-container">
				<div class="form-title">
					<h2>Neuer Eintrag</h2>
				</div>
				<input type="text" name="title" class="form-field" required="required" value="" />
				<input type="number" name="total_qty" min="0" value="" />
				<textarea rows="4" cols="50" name="note" class="form-field"></textarea>

				<input type="hidden" name="id" value="" />
				<input type="hidden" name="eventid" value="" />
				<input type="hidden" name="mode" value="new"/>
				<div class="submit-container">
					<input type="submit" name="submit" class="submit-button" value="Speichern">
				</div>
			</form>
		</div>
	</body>
</html>
