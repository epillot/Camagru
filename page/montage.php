<h3 align='center'>Selectionnez une image a superposer pour prendre une photo</h3>
<div id="montage_page">
<div class="container">
	<?php
	if (!$uploaded)
		echo "<video poster='img/unavailable.png' id='video' width='400' height='300' autoplay></video>";
	else
	{
		$src = 'data:image/' . $ret['ext'] . ';base64,' . $ret['file'];
		echo "<img src=$src width='400' height='300' id='upload'></img>";
	}
	?>
	<button id='take' onclick='takePhoto();'>Prendre une photo</button>
	<form method="post" action="#" enctype="multipart/form-data">
		<label for="upload">Charger un fichier :</label>
		<input type="file" name="upload" />
		<input type="submit" name="submit" value="Envoyer" />
	</form>
	<?php
	if (isset($err))
		echo "<p id='err'>$err</p>";
	?>
</div>
<div class="container">
	<canvas id="canvas" width="400" height="300"></canvas>
	<button id="register" onclick="savePhoto();">Enregistrer</button>
</div>
<div id="side">
</div>
<div id="imgadd">
	<img id="pikachu" src='img/pikachu.png' alt='pikachu' title='pikachu' onclick="selectImg(this);"></img>
	<img id="biere" src='img/biere.png' alt='biere' title='biere' onclick="selectImg(this);"></img>
	<img id="soleil" src='img/soleil.png' alt='soleil' title='soleil' onclick="selectImg(this);"></img>
</div>
</div>
<script type="text/javascript" src="js/video.js"></script>
