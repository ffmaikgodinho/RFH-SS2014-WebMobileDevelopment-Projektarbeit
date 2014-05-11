<!DOCTYPE HTML> 
<html>
	<head>
		<title>Event erstellen</title>
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	</head>
	<body> 
		<?php 	
			 if(isset($_POST['submit'])) { 
			 
				$title = $_POST["title"];

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
				
				// ToDo: $_POST["date"] $_POST["time"] zusammenfuehren
				
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
				 
				 // Account anlegen
				 if (isset($user) AND isset($password_md5)) {
					if (isset($email)) {
						$query = "INSERT INTO user (user, email, password)
									VALUES ('$user', '$email', '$password_md5')";
					} else {
						$query = "INSERT INTO user (user, password)
									VALUES ('$user', '$password_md5')";
					}
					//mysql_query($query);
					
					// debug
					 echo $user;
					 echo $password_md5;
				 }
			 }
		?>

		<form action="addevent.php" method="post" class="form-container">
			<div class="form-title">
				<h2>Event erstellen</h2>
			</div>
			<div class="form-title">
				Titel*: 
			</div> 
			<input type="text" name="title" class="form-field" required="required">
			<br />
			<div class="form-title">
				Veranstaltungsdatum: 
			</div> 
			<input type="date" name="date" value="<?php echo date('d/m/Y'); ?>" />
			<br />
			<div class="form-title">
				Beginn: 
			</div> 
			<input type="time" name="time" />
			<br />
			<div class="form-title">
				Ort: 
			</div> 
			<input type="text" name="location" />
			<br />
			<div class="form-title">
				Beschreibung: 
			</div> 
			<textarea rows="4" cols="50" name="desc" class="form-field"></textarea>
			<br />
			<div class="form-title">
				Eventtyp: 
			</div> 
			<input type="radio" name="type" value="1">Wunschliste<br />
			<input type="radio" name="type" value="2">Essen und Trinken<br />
			<div class="submit-container">
				<input type="submit" name="submit" class="submit-button" value="Speichern">
			</div>
		</form>
	</body>
</html>
