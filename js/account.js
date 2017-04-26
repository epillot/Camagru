var page = document.getElementsByClassName('page')[0];

function cleanPage() {
  var len = page.children.length;
  for (var i = 1; i < len; i++)
    page.removeChild(page.children[i]);
}

function modifPs() {
 cleanPage();
 var form = document.createElement("form");
 form.method = "post";
 form.action = '.?page=account';
 var newps = document.createElement("p");
 newps.innerText = "Nouveau pseudo";
 form.appendChild(newps);
 var input1 = document.createElement('input');
 input1.type = "text";
 input1.name = "newps";
 input1.minLength = '3';
 input1.maxLength = '20';
 input1.required = "required";
 form.appendChild(input1);
 var pw = document.createElement("p");
 pw.innerText = "Mot de passe";
 form.appendChild(pw);
 var input2 = document.createElement('input');
 input2.type = "password";
 input2.required = "required";
 input2.name = "pw";
 input2.minLength = '6';
 input2.maxLength = '30';
 form.appendChild(input2);
 var sub = document.createElement("input");
 sub.type = "submit";
 sub.name = "modifps";
 sub.value = "Ok";
 form.appendChild(sub);
 page.appendChild(form);
}

function modifPw() {
 cleanPage();
 var form = document.createElement("form");
 form.method = "post";
 form.action = '.?page=account';
 var oldpw = document.createElement("p");
 oldpw.innerText = "Mot de passe actuel";
 form.appendChild(oldpw);
 var input1 = document.createElement('input');
 input1.type = "password";
 input1.required = "required";
 input1.name = "oldpw";
 input1.minLength = '6';
 input1.maxLength = '30';
 form.appendChild( input1);
 var newpw1 = document.createElement("p");
 newpw1.innerText = "Nouveau mot de passe";
 form.appendChild(newpw1);
 var input2 = document.createElement('input');
 input2.type = "password";
 input2.required = "required";
 input2.name = "newpw";
 input2.minLength = '6';
 input2.maxLength = '30';
 form.appendChild(input2);
 var newpw2 = document.createElement("p");
 newpw2.innerText = "Confirmer mot de passe";
 form.appendChild(newpw2);
 var input3 = document.createElement('input');
 input3.type = "password";
 input3.required = "required";
 input3.name = "renewpw";
 input3.minLength = '6';
 input3.maxLength = '30';
 form.appendChild(input3);
 var sub = document.createElement("input");
 sub.type = "submit";
 sub.name = "modifpw";
 sub.value = "Ok";
 form.appendChild(sub);
 page.appendChild(form);
}

function modifMail() {
 cleanPage();
 var form = document.createElement("form");
 form.method = "post";
 form.onsubmit = 'return false';
 var newmail = document.createElement("p");
 newmail.innerText = "Nouvelle adresse email";
 form.appendChild(newmail);
 var input1 = document.createElement('input');
 input1.type = "email";
 input1.required = "required";
 form.appendChild(input1);
 var pw = document.createElement("p");
 pw.innerText = "Mot de passe";
 form.appendChild(pw);
 var input2 = document.createElement('input');
 input2.type = "password";
 input2.required = "required";
 form.appendChild(input2);
 var sub = document.createElement("input");
 sub.type = "submit";
 sub.value = "Ok";
 form.appendChild(sub);
 page.appendChild(form);
}
