<body>
	<?php require('header.php') ?>
	<div class="page">
		<?php //require('vue/sidebar.php') ?>
		<p>Salut <?= $_SESSION['loggued_on_user'] ?></p>
		<video></video>
	</div>
	<script>
		navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);
		navigator.getMedia({ video: true, audio: false }, function(stream) {
			var video = document.querySelector('video');
			video.src = window.URL.createObjectURL(stream);
			video.onloadedmetadata = function() {
				video.play();
			};
		}, function(e) {
			alert("Une erreur est survenue : ", e);
		});
	</script>
</body>
</html>
