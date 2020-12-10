var new_password = document.forms['form']['new_password'];
var confirm_password = document.forms['form']['confirm_password'];
var username = document.forms['form']['username'];

var password_error = document.getElementById('password_error');
var name_error = document.getElementById('name_error');

new_password.addEventListener('blur', newpasswordVerify, true);
username.addEventListener('blur', nameVerify, true);

function ResetValidate() {

  if (username.value == "" || username.value == null) {
    username.style.border = "solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }

  if (new_password.value == "" || new_password.value == null) {
    new_password.style.border = "solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    confirm_password.style.border = "solid red";
    password_error.textContent = "Password is required";
    new_password.focus();
    return false;
  }

  if (new_password.value.length < 6) {
    new_password.style.border = "solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    confirm_password.style.border = "solid red";
    password_error.textContent = "Password must be at least 6 characters";
    new_password.focus();
    return false;
  }

  if (new_password.value != confirm_password.value) {
    new_password.style.border = "solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    confirm_password.style.border = "solid red";
    password_error.innerHTML = "The two passwords do not match";
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

function newpasswordVerify() {
  if (new_password.value != "") {
  	new_password.style.border = "solid #5e6e66";
    confirm_password.style.border = "solid #5e6e66";
  	document.getElementById('pass_confirm_div').style.color = "#5e6e66";
  	document.getElementById('password_div').style.color = "#5e6e66";
  	password_error.innerHTML = "";
  	return true;
  }

  if (new_password.value === confirm_password.value) {
  	new_password.style.border = "solid #5e6e66";
  	document.getElementById('pass_confirm_div').style.color = "#5e6e66";
  	password_error.innerHTML = "";
  	return true;
  }
}
