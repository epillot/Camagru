var page = document.getElementById('account_page');
var cntner = document.getElementById('account_container');
var log_form = document.getElementById('log_form');
var pw_form = document.getElementById('pw_form');
var mail_form = document.getElementById('mail_form');


function cleanPage() {
  var len = cntner.children.length;
  for (var i = 1; i < len; i++)
    cntner.children[i].style.display = 'none';
}

function cleanForm() {
  var inputs = document.getElementsByClassName('input');
  var len = inputs.length;
  for (var i = 0; i < len; i++)
    inputs[i].value = "";
}

function modifPs() {
 cleanPage();
 document.getElementById('log_div').style.display = 'block';
}

function modifPw() {
 cleanPage();
 document.getElementById('pw_div').style.display = 'block';
}

function modifMail() {
 cleanPage();
 document.getElementById('mail_div').style.display = 'block';
}

log_form.onsubmit = function(ev) {
  ev.preventDefault();
  var xhr = new XMLHttpRequest();
  var form = new FormData(log_form);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      var len = page.children.length;
      for (var i = 1; i < len; i++)
        page.removeChild(page.children[i]);
      var p = document.createElement('p');
      var ret = JSON.parse(xhr.responseText);
      if (ret.success)
      {
        p.innerText = 'Votre pseudo à été modifié avec succès';
        document.getElementById('p_user').innerText = ret.log;
        cleanForm();
        cleanPage();
      }
      else
      {
        p.id = 'err';
        if (ret.err == 'wg ps len')
          p.innerText = 'Le pseudo doit contenir entre 3 et 20 caractères.';
        else if (ret.err == 'auth')
          p.innerText = 'Mot de passe incorrect.';
        else if (ret.err == 'user exists')
          p.innerText = 'Le login que vous avez choisi n\'est pas disponible.';
      }
      page.appendChild(p);
    }
  }
  xhr.open('POST', 'ajax_account.php', true);
  xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
  xhr.send(form);
}

pw_form.onsubmit = function(ev) {
  ev.preventDefault();
  var xhr = new XMLHttpRequest();
  var form = new FormData(pw_form);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      var len = page.children.length;
      for (var i = 1; i < len; i++)
        page.removeChild(page.children[i]);
      var p = document.createElement('p');
      var ret = JSON.parse(xhr.responseText);
      if (ret.success)
      {
        p.innerText = 'Votre mot de passe à été modifié avec succès';
        cleanForm();
        cleanPage();
      }
      else
      {
        p.id = 'err';
        if (ret.err == 'not same pw')
          p.innerText = 'Les deux mots de passe saisis ne sont pas identiques.';
        else if (ret.err == 'auth')
          p.innerText = 'Mot de passe incorrect.';
        else if (ret.err == 'invalid pw')
          p.innerText = 'Le mot de passe doit contenir entre 6 et 30 caractères et comporter au moins un chiffre et une lettre.';
      }
      page.appendChild(p);
    }
  }
  xhr.open('POST', 'ajax_account.php', true);
  xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
  xhr.send(form);
}

mail_form.onsubmit = function(ev) {
  ev.preventDefault();
  var xhr = new XMLHttpRequest();
  var form = new FormData(mail_form);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      var len = page.children.length;
      for (var i = 1; i < len; i++)
        page.removeChild(page.children[i]);
      var p = document.createElement('p');
      var ret = JSON.parse(xhr.responseText);
      if (ret.success)
      {
        p.innerText = 'Votre email à été modifié avec succès';
        document.getElementById('p_mail').innerText = ret.mail;
        cleanForm();
        cleanPage();
      }
      else
      {
        p.id = 'err';
        if (ret.err == 'invalid mail')
          p.innerText = 'Votre adresse email n\'est pas valide.';
        else if (ret.err == 'auth')
          p.innerText = 'Mot de passe incorrect.';
        else if (ret.err == 'mail exists')
          p.innerText = 'Cette adresse email à déjà été utilisée.';
      }
      page.appendChild(p);
    }
  }
  xhr.open('POST', 'ajax_account.php', true);
  xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
  xhr.send(form);
}
