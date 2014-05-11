<!DOCTYPE HTML> 
<html>
	<head>
		<title>Eintrag anlegen</title>
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	</head>
	<body> 
		<?php 
			$userErr = "";
			$passwordErr = "";
				
			 if(isset($_POST['submit'])) { 		
				 // Validierung
				if (empty($_POST["user"])) {
					$userErr = "Die Angabe eines Namens ist erforderlich.";
				} else {
					$user = $_POST["user"];
				}
				
				if (empty($_POST["password"]))  {
					$passwordErr = "Die Angabe eines Passworts ist erforderlich.";
				} else {
					$password_md5 = md5($_POST["password"]); 
				}
				
				if (empty($_POST["email"])) {
					$email = "";
				} else {
					$email = $_POST["email"];
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

		<form action="additem.php" method="post" class="form-container">
			<div class="form-title">
				<h2>Eintrag anlegen</h2>
			</div>
			<div class="form-title">
				Titel*: 
				<?php echo '<br /><span>'.$titleErr.'</span>'; ?>
			</div> 
			<input type="text" name="title" class="form-field">
			<br />
			<div class="form-title">
				Passwort*: 
				<?php echo '<br /><span>'.$passwordErr.'</span>'; ?>
			</div> 
			<input type="password" name="password" class="form-field">
			<div class="form-title">
				E-Mail: 
			</div> 
			<input type="text" name="email" class="form-field">
			<div class="submit-container">
				<input type="submit" name="submit" class="submit-button" value="Registrieren">
			</div>
		</form>
	</body>
</html>
