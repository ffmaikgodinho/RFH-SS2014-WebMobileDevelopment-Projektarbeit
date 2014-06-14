<!DOCTYPE HTML> 
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/desktop2.css">
		<title>Beitrag stellen</title>
		<!--<link rel="stylesheet" type="text/css" href="style.css">-->
	</head>
	<body> 
		<?php 	
			// ToDo: check if user is logged in 
			// then get userid, otherwise ask for name	
			$isUserLoggedIn = TRUE;
			
			// get entry information to contribute to
			if(isset($_GET["id"])){
					$currentID = $_GET["id"];
				} else {
					$currentID = 0;
				}
				
				$query = "SELECT id, title, total_qty 
						  FROM entry 
						  WHERE id=$currentID";
						  
				//mysql_query($query);	
				$total_qty = 10; // ToDo: get from query
				$item_title = "foo"; // ToDo: get from query
				
				//debug  
				echo $query;
				
			// write contribution to database
			if(isset($_POST['submit'])) { 
			 
				$quantity = $_POST["quantity"];
				 
				 // Account anlegen
				 if ($isUserLoggedIn == TRUE) {
						$query = "INSERT INTO contribution (userid, entryid, quantity)
									VALUES ('$userid', '$currentID', '$quantity')";
				 } else {
				 	$query = "INSERT INTO contribution (name, entryid, quantity)
									VALUES ('$name', '$currentID', '$quantity')";				
				}
					//mysql_query($query);
					
					// debug
					 echo $query;
				 }
		?>
		<div id="content-limiter">
			<div class="content-item">
				<form action="contributeitem.php" method="post" class="form-container">
					<div class="content-head">
						<p class="content-title">
							Beitrag leisten f&uuml;r <?php echo $item_title; ?>
						</p>
						<p class="content-creator">
						</p>
					</div>
					<div class="content-area">
						<?php  
							if($isUserLoggedIn == FALSE) {
								echo "<div class=\"form-title\">";
								echo "Name*:";
								echo "</div>";
								echo "<input type=\"text\" name=\"name\" class=\"form-field\" required=\"required\">";
							}
						?>
						<div class="form-title">
							Menge: 
						</div> 
						<input type="number" name="quantity" class="form-field" required="required" min="0" max="<?php echo $total_qty; ?>">
						<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Abschicken">
						</div>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
