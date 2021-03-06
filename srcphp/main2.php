
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
<!--Anzeige Liste-->
			<div class="content-item" id="list">
				<div class="content-head">
					<p class="content-title">
						Eventliste
					</p>
				</div>
				<div class="list-area">
					<div class="list-entry">
						<p class="list-entry-title">
							Eintrag 1
						</p>
						<span class="list-entry-item">Wann:&nbsp;</span><span class="list-entry-fact">19.08.2014 - 18:00 Uhr</span><span class="list-entry-item">Wo:&nbsp;</span><span class="list-entry-fact">Luxemburger Str. 227, 50937 Köln</span>
					</div>
					<div class="list-entry">
						<p class="list-entry-title">
							Eintrag 2
						</p>
						<span class="list-entry-item">Wann:&nbsp;</span><span class="list-entry-fact">25.08.2014 - 20:00 Uhr</span><span class="list-entry-item">Wo:&nbsp;</span><span class="list-entry-fact">Bei David zu Hause!</span>
					</div>
					<div class="list-entry">
						<p class="list-entry-title">
							Eintrag 3
						</p>
						<span class="list-entry-item">Wann:&nbsp;</span><span class="list-entry-fact">01.09.2014 - 18:00 Uhr</span><span class="list-entry-item">Wo:&nbsp;</span><span class="list-entry-fact">Brauhaus Gaffel am Dom</span>
					</div>
					<div class="list-entry">
						<p class="list-entry-title">
							Eintrag 4
						</p>
						<span class="list-entry-item">Wann:&nbsp;</span><span class="list-entry-fact">09.10.2014 - 18:00 Uhr</span><span class="list-entry-item">Wo:&nbsp;</span><span class="list-entry-fact">Luxemburger Str. 227, 50937 Köln</span>
					</div>
				</div>
			</div>
<!--Anzeige Einzelcontent-->
			<div class="content-item" id="content">
				<div class="content-head">
					<p class="content-creator">
						erstellt von d3nis
					</p>
					<p class="content-title">
						Anzeige Einzelcontent (bspw: Content)
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
<!-- Ab hier Additem -->
			<div class="content-item" id="create_event">
				<div class="content-head">
					<p class="content-creator">
						erstellt von <a href="d3nis.php">eingelogter</a>
					</p>
					<p class="content-title">
						Event anlegen / anzeigen / bearbeiten
					</p>
				</div>
				<div class="content-area">
					<form action="addevent.php" method="post" class="form-container">
<!--						<input type="text" name="title" class="form-field" required="required" placeholder="Titel" value="" />
-->						<br><span class="form-title">Datum:</span><input type="date" name="date" class="event-formfield event-formfield-empty" placeholder="" value="" />
						<br><span class="form-title">Uhrzeit:</span><input type="time" name="time" class="event-formfield event-formfield-empty" placeholder="" value="" />
						<br><span class="form-title">Ort:</span><input type="text" name="location" class="event-formfield event-formfield-empty" placeholder="" value="" />
						<br><textarea rows="4" cols="50" name="desc" class="event-formfield event-formfield-empty" placeholder="Beschreibung"></textarea>
<!--						<input type="radio" name="type" value="1" >Wunschliste<br />
						<input type="radio" name="type" value="2" >Essen und Trinken<br />
-->						<input type="hidden" name="id" value=""/>
						<input type="hidden" name="editmode" value=""/>
<!--					<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Speichern">
						</div>
-->					</form>
				</div>
<!-- ab hier die items -->
				<div class="list">
					Liste
				</div>
				<div class="item">				
					<form action="additem.php" method="post" class="item">
							<input type="text" name="title" class="item_title item_title-empty" required="required" value="" placeholder="" />
							<input type="number" name="total_qty" min="0" class="item_qty item_qty-empty" value="" placeholder="" />
							<textarea rows="3" name="note" class="item_note item_note-empty" placeholder="Notiz"></textarea>
							<input type="hidden" name="id" value="" />
							<input type="hidden" name="eventid" value="" />
							<input type="hidden" name="editmode" value=""/>
<!--							<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Speichern">
						</div> -->
					</form>
					<div class="contribution">
						<input type="text" name="name" class="contribute_name contribute_name-empty" required="required" min="0" max=""placeholder="> eintragen">
						<input type="number" name="quantity" class="contribute_qty contribute_qty-empty" required="required" min="0" max="">
					</div>
				</div>
			</div>
<!-- Additem ende -->
<!-- Addevent ende -->			
<!-- Ab hier Additem -->
			<div class="content-item" id="show_event">
				<div class="content-head">
					<p class="content-creator">
						erstellt von <a href="d3nis.php">Ersteller</a>
					</p>
					<p class="content-title">
						Grillparty
					</p>
				</div>
				<div class="content-area">
					<form action="addevent.php" method="post" class="form-container">
<!--						<input type="text" name="title" class="form-field" required="required" placeholder="Titel" value="" />
-->						<br><span class="form-title">Datum:</span><input type="date" name="date" class="event-formfield" placeholder="Datum" value="" />
						<br><span class="form-title">Uhrzeit:</span><input type="time" name="time" class="event-formfield" placeholder="Urhzeit" value="" />
						<br><span class="form-title">Ort:</span><input type="text" name="location" class="event-formfield" placeholder="Ort" value="" />
						<br><textarea rows="4" cols="50" name="desc" class="event-formfield" placeholder="Beschreibung" class="form-field"></textarea>
<!--						<input type="radio" name="type" value="1" >Wunschliste<br />
						<input type="radio" name="type" value="2" >Essen und Trinken<br />
-->						<input type="hidden" name="id" value=""/>
						<input type="hidden" name="editmode" value=""/>
<!--					<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Speichern">
						</div>
-->					</form>
				</div>
<!-- ab hier die items -->
				<div class="list">
					Liste
				</div>	
				<div class="item">				
					<form action="additem.php" method="post" class="item">
							<input type="text" name="title" class="item_title" required="required" value="" />
							<input type="number" name="total_qty" min="0" class="item_qty" value="" />
							<textarea rows="3" name="note" class="item_note"></textarea>
							<input type="hidden" name="id" value="" />
							<input type="hidden" name="eventid" value="" />
							<input type="hidden" name="editmode" value=""/>
<!--							<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Speichern">
						</div> -->
					</form>
					<div class="contribution">
						<input type="text" name="name" class="contribute_name" required="required" min="0" max="">
						<input type="number" name="quantity" class="contribute_qty" required="required" min="0" max="">
					</div>
					<div class="contribution">
						<input type="text" name="name" class="contribute_name" required="required" min="0" max="">
						<input type="number" name="quantity" class="contribute_qty" required="required" min="0" max="">
					</div>
				</div>
				<div class="item">				
					<form action="additem.php" method="post" class="item">
							<input type="text" name="title" class="item_title" required="required" value="" />
							<input type="number" name="total_qty" min="0" class="item_qty" value="" />
							<textarea rows="3" name="note" class="item_note"></textarea>
							<input type="hidden" name="id" value="<?php echo $q_id; ?>" />
							<input type="hidden" name="eventid" value="" />
							<input type="hidden" name="editmode" value=""/>
<!--							<div class="submit-container">
							<input type="submit" name="submit" class="submit-button" value="Speichern">
						</div> -->
					</form>
					<div class="contribution">
						<input type="text" name="name" class="contribute_name" required="required" min="0" max="">
						<input type="number" name="quantity" class="contribute_qty" required="required" min="0" max="">
					</div>
					<div class="contribution">
						<input type="text" name="name" class="contribute_name" required="required" min="0" max="">
						<input type="number" name="quantity" class="contribute_qty" required="required" min="0" max="">
					</div>
				</div>
			</div>
<!-- Additem ende -->
		<div id="footer">
			copyright 2014 bla bla blub | Impressum
		</div>
	</body>
</html>