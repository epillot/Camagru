function addComment(comment) {
  var container = document.getElementById('com_content');
  var new_com = document.createElement('p');
  new_com.innerText = 'vous: ' + comment;
  if (container.children[0].id == 'no_comment')
    container.removeChild(container.children[0]);
  container.insertBefore(new_com, container.children[0]);
}

function sendComment() {
  var comment = document.getElementById('write_com').children[1].value;
  if (comment.length == 0)
  {
    alert('Votre commentaire est vide.');
    return;
  }
  if (comment.length > 250)
  {
    alert('Maximum 250 caractères pour un commentaire, actuellement ' + comment.length + ' caractères.');
    return;
  }
  var id = document.getElementById('comment_page').children[0].id;
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
        addComment(comment);
        document.getElementById('write_com').children[1].value = "";
    }
  };
  xhr.open('POST', 'ajax_comment.php', true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send('uidph=' + id + '&comment=' + comment);
}
