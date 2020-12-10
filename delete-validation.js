var username = document.forms['form']['username'];
var email = document.forms['form']['email'];

var name_error = document.getElementById('name_error');
var email_error = document.getElementById('email_error');

username.addEventListener('blur', nameVerify, true);
email.addEventListener('blur', emailVerify, true);

function DeleteValidate() {

  if (username.value == "" || username.value == null) {
    username.style.border = "solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }

  if (email.value == "" || email.value == null) {
    email.style.border = "solid red";
    document.getElementById('email_div').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }
}

function nameVerify() {
  if (username.value != "") {
   username.style.border = "solid #5e6e66";
   document.getElementById('username_div').style.color = "#5e6e66";
   name_error.innerHTML = "";
   return true;
  }
}

function emailVerify() {
  if (email.value != "") {
  	email.style.border = "solid #5e6e66";
  	document.getElementById('email_div').style.color = "#5e6e66";
  	email_error.innerHTML = "";
  	return true;
  }
}
