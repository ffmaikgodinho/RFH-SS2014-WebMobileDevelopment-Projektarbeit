<!DOCTYPE HTML> 
<html>
	<head>
		<title>Registrieren</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body> 
		<?php 
			$userErr = "";
			$passwordErr = "";
			$emailErr = "";
			
			 if(isset($_POST['submit'])) { 
				$regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
				
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
					if (preg_match($regex_email, $_POST["email"])) {
						$email = $_POST["email"];
					} else { 
						$email = "";
						$emailErr = "Die E-Mail Adresse ist ung&uuml;ltig.";
					}
				}
				 
				 // Account anlegen
				 if (isset($user) AND isset($password_md5) AND empty($emailErr)) {
					$query = "INSERT INTO user (user, email, password)
							VALUES ('$user', '$email', '$password_md5')";
					//mysql_query($query);
					
					// debug
					 echo $user;
					 echo $password_md5;
				 }
			 }
		?>

		<form action="register.php" method="post" class="form-container">
			<div class="form-title">
				<h2>Registrieren</h2>
			</div>
			<div class="form-title">
				Name*: 
				<?php echo '<br /><span>'.$userErr.'</span>'; ?>
			</div> 
			<input type="text" name="user" class="form-field">
			<br />
			<div class="form-title">
				Passwort*: 
				<?php echo '<br /><span>'.$passwordErr.'</span>'; ?>
			</div> 
			<input type="password" name="password" class="form-field">
			<div class="form-title">
				E-Mail:
				<?php echo '<br /><span>'.$emailErr.'</span>'; ?>
			</div> 
			<input type="text" name="email" class="form-field">
			<div class="submit-container">
				<input type="submit" name="submit" class="submit-button" value="Registrieren">
			</div>
		</form>
	</body>
</html>
