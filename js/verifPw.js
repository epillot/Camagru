function verifPw() {
	var pw = document.getElementById("pw1").value;
	var repw = document.getElementById("pw2").value;
	if (pw !== repw)
	{
		alert('Les deux mots de passe saisis ne sont pas identiques');
		return false;
	}
	return true;
}
