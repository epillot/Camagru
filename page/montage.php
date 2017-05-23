<div class="container">
	<video poster="img/unavailable.png" id="video" width="500" height="400" autoplay></video>
	<button id="take" onclick='takePhoto();'>Prendre une photo</button>
</div>
<div class="container">
	<canvas id="canvas" width="400" height="300"></canvas>
	<button id="register" onclick="savePhoto();">Enregistrer</button>
	<form method="post" action="#" enctype="multipart/form-data">
		<label for="upload">Charger un fichier :</label>
		<input type="file" name="upload" />
		<input type="submit" name="submit" value="Envoyer" />
	</form>
</div>
<div id="side">
</div>
<!-- <div id="imgadd">
</div> -->
<script type="text/javascript" src="js/video.js"></script>
