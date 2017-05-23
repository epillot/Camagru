var streaming = false;
var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var save_button = document.getElementById('register');
var take_button = document.getElementById('take');
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
  take_button.style.display = "none";
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

function addPreview(src) {
  var img = document.createElement('img');
  var side = document.getElementById('side');
  img.src = src;
  img.className = 'preview';
  img.alt = 'photo';
  if (side.children.length == 4)
    side.removeChild(side.children[3]);
  side.insertBefore(img, side.children[0]);
}

function savePhoto() {
  var src = canvas.toDataURL();
  var url = encodeURIComponent(src.split(',')[1]);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      alert("Votre photo a bien été enregistrée !");
      addPreview(src);
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
