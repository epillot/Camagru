function deletePhoto(a) {
    var photo = a.parentNode.parentNode;
    var src = photo.children[0].src;
    var uidph = photo.children[0].id;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200)
      {
        photo.parentNode.removeChild(photo);
        alert('Votre photo a été supprimée !');
        //console.log(xhr.responseText);
      }
    };
    xhr.open('POST', 'ajax_gallery.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('delete=' + src + '&uidph=' + uidph);
}

function addLike(elem, l) {
  var para = elem.innerHTML;
  var nb = parseInt(para.substring(6));
  l ? nb++ : nb--;
  elem.innerHTML = 'aimée ' + nb + ' fois';
}

function ajaxLike(l, uidph) {
  var xhr = new XMLHttpRequest();
  var action = l ? 'like' : 'unlike';
  xhr.open('POST', 'ajax_gallery.php', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send('like_action=' + action + '&uidph=' + uidph);
}

function likeOrUnlike(elem) {
  var newlike = document.createElement('img');
  var ok = false;
  var l;
  var uidph = elem.parentNode.parentNode.children[0].id;
  if (elem.children[0].className == 'notlike')
  {
    newlike.alt = 'unlike';
    newlike.title = 'unlike';
    newlike.className = 'liked';
    newlike.src = 'img/active_like.png';
    l = true;
    ok = true;
  }
  else if (elem.children[0].className == 'liked')
  {
    newlike.alt = 'like';
    newlike.title = 'like';
    newlike.className = 'notlike';
    newlike.src = 'img/like.png';
    l = false;
    ok = true;
  }
  if (ok)
  {
    elem.removeChild(elem.children[0]);
    elem.appendChild(newlike);
    addLike(elem.parentNode.children[1], l);
    ajaxLike(l, uidph);
  }
}
