var create_form = document.getElementById('create_form');
var page = document.getElementById('accueil_page');
var forgot = document.getElementById('forgot');

function cleanPageAndForm() {
  for (var i = 2; i < page.children.length; i++)
    page.removeChild(page.children[i]);
  var inputs = document.getElementsByClassName('input');
  for (var j = 0; j < inputs.length; j++)
  {
    inputs[j].style.border = '2px inset';
  }
}

create_form.onsubmit = function(ev) {
  ev.preventDefault();
  var xhr = new XMLHttpRequest();
  var form = new FormData(create_form);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      cleanPageAndForm();
      var ret = JSON.parse(xhr.responseText);
      var info = document.createElement('p');
      if (ret.success)
      {
        var info = document.createElement('div');
        var p1 = document.createElement('p');
        var p2 = document.createElement('p');
        var p3 = document.createElement('p');
        p1.innerText = 'Votre compte a été créé avec succès !';
        p2.innerText = 'Un email de confirmation vous a été envoyé.';
        p3.innerText = 'Merci de suivre la procédure indiquée pour finaliser votre inscription.';
        info.appendChild(p1);
        info.appendChild(p2);
        info.appendChild(p3);
        page.appendChild(info);
        for (var i = 1; i < create_form.children.length; i += 2)
          create_form.children[i].value = "";
      }
      else
      {
        var p = document.createElement('p');
        p.id = 'err';
        if (ret.err == 'not same pw')
        {
          p.innerText = 'Les deux mots de passe saisis ne sont pas identiques.';
          document.getElementById('pw1').style.border = '1px solid red';
          document.getElementById('pw2').style.border = '1px solid red';
        }
        else if (ret.err == 'wg ps len')
        {
          p.innerText = 'Le pseudo doit contenir entre 3 et 20 caractères.';
          document.getElementById('log').style.border = '1px solid red';
        }
        else if (ret.err == 'wg pw')
        {
          p.innerText = 'Le mot de passe doit contenir entre 6 et 30 caractères et comporter au moins un chiffre et une lettre.';
          document.getElementById('pw1').style.border = '1px solid red';
        }
        else if (ret.err == 'user exists')
        {
          p.innerText = 'Le login que vous avez choisi n\'est pas disponible.';
          document.getElementById('log').style.border = '1px solid red';
        }
        else if (ret.err == 'invalid mail')
        {
          p.innerText = 'Votre adresse email n\'est pas valide';
          document.getElementById('mail').style.border = '1px solid red';
        }
        else if (ret.err == 'mail exists')
        {
          p.innerText = 'Cette adresse email à déjà été utilisée.';
          document.getElementById('mail').style.border = '1px solid red';
        }
        page.appendChild(p);
      }
    }
  };
  xhr.open('POST', 'ajax_accueil.php', true);
  xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
  xhr.send(form);
}

forgot.onclick = function(ev) {
  document.getElementById('forgot_div').style.display = 'flex';
}

forgot_form.onsubmit = function(ev) {
  ev.preventDefault();
  var xhr = new XMLHttpRequest();
  var form = new FormData(forgot_form);
  if (forgot_form.children[3])
    forgot_form.removeChild(forgot_form.children[3]);
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200)
    {
      var ret = JSON.parse(xhr.responseText);
      var p = document.createElement('p');
      if (ret.success)
        p.innerText = 'Un email email contenant votre nouveau mot de passe vous a été envoyé !';
      else
      {
        p.id = 'err';
        p.innerText = 'Cet email ne correspond a aucun utilisateur.';
      }
      forgot_form.appendChild(p);
    }
  }
  xhr.open('POST', 'ajax_accueil.php', true);
  xhr.setRequestHeader('X-Requested-With', 'xmlhttprequest');
  xhr.send(form);
}
