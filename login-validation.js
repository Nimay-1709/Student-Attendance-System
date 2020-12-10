var username = document.forms['form']['username'];
var password = document.forms['form']['password'];

var name_error = document.getElementById('name_error');
var password_error = document.getElementById('password_error');

username.addEventListener('blur', nameVerify, true);
password.addEventListener('blur', passwordVerify, true);

function LoginValidate() {

  if (username.value == "" || username.value == null) {
    username.style.border = "solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }

  if (password.value == "" || password.value == null) {
    password.style.border = "solid red";
    document.getElementById('password_div').style.color = "red";
    password_error.textContent = "Password is required";
    password.focus();
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

function passwordVerify() {
  if (password.value != "") {
    password.style.border = "solid #5e6e66";
    document.getElementById('password_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
}
