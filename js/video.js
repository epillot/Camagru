var streaming = false;
var video = document.getElementById('video');
var img_up = document.getElementById('upload');
var canvas = document.getElementById('canvas');
var save_button = document.getElementById('register');
var take_button = document.getElementById('take');
var pikachu = document.getElementById('pikachu');
var width = 400;
var height = 0;
var selected = false;
var allimg = document.getElementById('imgadd');

if (video){
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
}

function selectImg(img) {
  for (var i = 0; i < allimg.children.length; i++)
     allimg.children[i].style.backgroundColor = '#fff';
  img.style.backgroundColor = '#D0F5A9';
  selected = true;
}

function getFilter() {
  for (var i = 0; i < allimg.children.length; i++)
  {
    if (allimg.children[i].style.backgroundColor == "rgb(208, 245, 169)"){
      break; }
  }
  return i == 3 ? 2 : i;
}

function applyFilter(photo, filter) {
  // console.log(photo);
  // console.log(filter);
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      //console.log(xhr.responseText);
      var img = new Image();
      img.onload = function() {
        canvas.getContext('2d').drawImage(img, 0, 0, width, height);
        save_button.style.visibility = "visible";
      };
      img.src = 'data:image/png;base64,' + xhr.responseText;
    }
  };
  xhr.open('POST', 'ajax_montage.php', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send('photo=' + photo + '&filter=' + filter);
}

function takePhoto() {
  var src;
  if (selected) {
  var filter = getFilter();
  console.log(filter);
  var tmpcanvas = document.createElement('canvas');
  tmpcanvas.width = 400;
  tmpcanvas.height = 300;
  if (video)
    src = video;
  else
  {
    width = img_up.width;
    height = img_up.height;
    src = img_up;
  }
  tmpcanvas.getContext('2d').drawImage(src, 0, 0, width, height);
  var dst = encodeURIComponent(tmpcanvas.toDataURL().split(',')[1]);
  applyFilter(dst, filter);
  }
  else {
    alert('veillez selectionner une image à superposer');
  }
}

function addPreview(src) {
  var img = document.createElement('img');
  var side = document.getElementById('side');
  img.src = src;
  img.className = 'preview';
  img.alt = 'photo';
  if (side.children.length == 3)
    side.removeChild(side.children[2]);
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
}
