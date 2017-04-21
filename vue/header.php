<div id="header">
	<div id="home">
		<a href="index.php"><img src="img/home.png" alt="home" title="home"></img></a>
	</div>
	<div id="title">
		<h1>Camagru</h1>
	</div>
	<?php
		if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "")
		{
			echo "<div id='logout'>";
			echo "<a href='logout.php'><img src='img/logout.png' title='logout' alt='logout'></img></a>";
			echo "</div>";
		}
	?>
</div>
