<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Camagru</title>
	<link rel="stylesheet" href="page/style.css">
</head>
<body>
<div id="header">
	<div id="home">
		<a href="index.php"><img src="img/home.png" alt="home" title="home"></img></a>
		<a href='index.php?p=gallery'><img src='img/gallery.png' title='gallerie' alt='gallerie'></img></a>
	</div>
		<h1>Camagru</h1>
	<div id="user_setting">
		<?php
			if (isset($_SESSION['loggued_on_user']) && $Data->userExists($_SESSION['loggued_on_user']))
			{
				echo "<div id='compte'>";
				echo "<a href='index.php?p=account'><img src='img/compte.png' title='Mon compte' alt='Mon compte'></img></a>";
				echo "</div>";
				echo "<div id='logout'>";
				echo "<a href='logout.php'><img src='img/logout.png' title='logout' alt='logout'></img></a>";
				echo "</div>";
			}
		?>
	</div>
</div>
<div class="page">
  <?= $page ?>
</div>
</body>
</html>
