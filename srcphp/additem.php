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
			function showNewContributionForm($entryid) {
				document.getElementById('newContribution-' + $entryid).style.visibility = "visible";
			}
		</script>
	</head>
	<body> 
		<?php 	
			// ToDo: check if user is logged in 
			// then get userid, otherwise ask for name	
			$isUserLoggedIn = TRUE;
			$userid = 5;
			
			if(isset($_GET["eventid"])){
				$q_eventid = $_GET["eventid"];
			} else {
				$q_eventid = 0;
			}
			// get entryid
			if(isset($_GET["entryid"])){
				$currentID = $_GET["entryid"];
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
			  		  				
				if ($_POST["mode"] == "contribution") {
				  $quantity = $_POST["quantity"];
					$entry_id =$_POST["entryid"];
					
					 // Account anlegen
					 if ($isUserLoggedIn) {
							$query = "INSERT INTO contribution (userid, entryid, quantity)
										VALUES ('$userid', '$entry_id', '$quantity')";
					 } else {
						$query = "INSERT INTO contribution (name, entryid, quantity)
										VALUES ('$name', '$entry_id', '$quantity')";				
					}
						//mysql_query($query);
				}
				
				if (($_POST["mode"] == "update") OR ($_POST["mode"] == "new") ) {
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
				}
				
				if ($_POST["mode"] == "update") {
				
				$query = "UPDATE entry 
						  SET eventid='$eventid', 
							  title='$title',
						      note='$note', 
						      total_qty = '$total_qty'
							WHERE id=$id";
				}
				
				if ($_POST["mode"] == "new") {
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
			
			$isUserLoggedIn;
			if($isUserLoggedIn) { 
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
				
				if ($isUserLoggedIn)
					echo "<input type=\"submit\" name=\"submit\" class=\"submit-button\" value=\"Speichern\">";
				echo "</form>";
				
				// ** contribution list of each entry
				// ToDo: $contributions = get_allcontributionsforentry($entryid)
				// id, userid, name, entryid, quantity
				$contributions = [[2, 1, "Hans", 2, 1],[3, 5, "Wurst", 2, 2]];
				
				foreach ($contributions as list($contribution_id, $user_id, $username, $entryid, $contribution_qty)) {
					if ($entry_id == $entryid) {
						echo "<span>".$username."</span>";
						echo "<span>".$contribution_qty."</span>";
						echo "<br />";
					}
				}
				
				//ToDo: Sum the values in array 'contributions'
				$sum_contribtions = 3;
				
					echo "<img src=\"img\\new-icon.png\" onclick=\"javascript:showNewContributionForm(".$entry_id.")\">";
					
					echo "<div class=\"content-item\" id=\"newContribution-".$entry_id."\" style=\"visibility:hidden\">";
					echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\" class=\"form-container\">";
					
					if(!$isUserLoggedIn) {
						echo "<div class=\"form-title\">";
						echo "Name*:";
						echo "</div>";
						echo "<input type=\"text\" name=\"name\" class=\"form-field\" required=\"required\">";
					}
					
					echo "<div class=\"form-title\">Menge:</div>";
					echo "<input type=\"number\" name=\"quantity\" class=\"form-field\" required=\"required\" min=\"0\" max=\"".$entry_qty."\">";
					echo "<input type=\"hidden\" name=\"mode\" value=\"contribution\"/>";
					echo "<input type=\"hidden\" name=\"entryid\" value=\"".$entry_id."\"/>";
					echo "<div class=\"submit-container\">";
					echo "<input type=\"submit\" name=\"submit\" class=\"submit-button\" value=\"Abschicken\">";
					echo "</div>";
					echo "</form>";
					echo "</div>";
			
			}
		?>
		
		<!-- New Item -->
		<?php
		$userIsAdmin = $isUserLoggedIn;
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