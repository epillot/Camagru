function deletePhoto(a) {
    var photo = a.parentNode.parentNode;
    var src = photo.children[0].src;
    console.log(src);
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4 && xhr.status == 200)
      {
        photo.parentNode.removeChild(photo);
        alert('Votre photo a été supprimée !');
        console.log(xhr.responseText);
      }
    };
    xhr.open('POST', 'ajax_gallery.php', true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send('delete=' + src);

}
