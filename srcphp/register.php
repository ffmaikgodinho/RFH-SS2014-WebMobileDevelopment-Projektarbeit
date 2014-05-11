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
				
			 if(isset($_POST['submit'])) 
			{ 		
				 // Validierung
				if (empty($_POST["user"])) 
				{
					$userErr = "Die Angabe eines Namen ist erforderlich.";
				} else 
				{
					$user = $_POST["user"];
				}
				
				if (empty($_POST["password"])) 
				{
					$passwordErr = "Die Angabe eines Passworts ist erforderlich.";
				} else 
				{
					$password_md5 = md5($_POST["password"]); 
				}
				 
				 if (isset($user) AND isset($password_md5))
				 {
					//$register = mysql_query('INSERT INTO user VALUES ('$user,$password_md5');');
					
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
				<?php echo $userErr; ?>
			</div> 
			<input type="text" name="user" class="form-field">
			<br />
			<div class="form-title">
				Passwort*: 
				<?php echo $passwordErr; ?>
			</div> 
			<input type="password" name="password" class="form-field">
			<div class="submit-container">
				<input type="submit" name="submit" class="submit-button" value="Registrieren">
			</div>
		</form>
	</body>
</html>
