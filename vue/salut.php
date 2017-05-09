<body>
	<?php require('header.php') ?>
	<div class="page">
		<div class="container">
			<video id="video" width="500" height="400" autoplay></video>
			<button onclick="takePhoto();">Prendre une photo</button>
		</div>
		<div class="container">
			<canvas id="canvas" width="640" height="480"></canvas>
			<button id="register">Enregistrer</button>
		</div>
	</div>
	<script type="text/javascript" src="js/video.js"></script>
</body>
</html>
