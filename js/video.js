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

function savePhoto() {
  var url = encodeURIComponent(canvas.toDataURL().split(',')[1]);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {

    }
  };
  xhr.open('POST', '.', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send('photo=' + url);
  //console.log(url);
  // var form = document.createElement('form');
  // form.method = 'post';
  // form.action = '.';
  // var input = document.createElement('input');
  // input.type = 'hidden';
  // input.name = 'photo';
  // input.value = url;
  // form.appendChild(input);
  // document.body.appendChild(form);
  // form.submit();
}
