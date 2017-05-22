<?php
	if ($_GET['i'] == 'created')
	{
		echo "<div>";
		echo "<p>Votre compte a été créé avec succès !</p>";
		echo "<p>Un email de confirmation vous a été envoyé.</p>";
		echo "<p>Merci de suivre la procédure indiquée pour finaliser votre inscription.</p>";
		echo "</div>";
	}
	else if ($_GET['i'] == 'notactive')
	{
		echo "<div>";
		echo "<p>Votre compte n'a pas été activé.</p>";
		echo "<p>Un email de confirmation vous a été envoyé à la création de votre compte.</p>";
		echo "<p>Merci de suivre la procédure indiquée pour finaliser votre inscription.</p>";
		echo "</div>";
	}
?>
<p><a href="index.php">Retour à l'accueil</a><p>
