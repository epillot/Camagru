var streaming = false;
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var save_button = document.getElementById('register');
var width = 400;
var height = 0;
navigator.getMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);
navigator.getMedia(
  { video: true, audio: false },
  function(stream) {
  video.src = window.URL.createObjectURL(stream);
},
function(e) {
  alert("Une erreur est survenue : ", e);
});

video.addEventListener('canplay', function(ev){
  if (!streaming)
  {
    height = video.videoHeight / (video.videoWidth / width);
    video.width = width;
    video.height = height;
    canvas.width = width;
    canvas.height = height;
    streaming = true;
  }
}, false);

function takePhoto() {
  canvas.getContext('2d').drawImage(video, 0, 0, width, height);
  save_button.style.visibility = "visible";
}
