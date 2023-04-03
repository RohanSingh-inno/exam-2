
function fnameValid() {
  var pass = document.getElementById("fname").value;
  var regex = /^[a-zA-Z-']*$/;
  if (!pass.match(regex)) {

    document.getElementById("fnameErr").innerHTML = `<span style = "color:red">Please enter your correct first name</span>`
    document.getElementById("register").disabled = true;
  }
  else {

    document.getElementById("fnameErr").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
function lnameValid() {
  var pass = document.getElementById("lname").value;
  var regex = /^[a-zA-Z-']*$/;
  if (!pass.match(regex)) {

    document.getElementById("lnameErr").innerHTML = `<span style = "color:red">Please enter your correct last name</span>`
    document.getElementById("register").disabled = true;
  }
  else {

    document.getElementById("lnameErr").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
function emailValid() {
  var mail = document.getElementById('email').value;
  var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  if (!mail.match(regex)) {

    document.getElementById("emailErr").innerHTML = `<span style="color:red;">Pleas enter your correct Email Id<span>`;
    document.getElementById("register").disabled = true;
  } else {

    document.getElementById("emailErr").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
function phoneValid() {
  var pass = document.getElementById("phone").value;
  var regex = /^(\+91)[0-9]{10}$/;
  if (!pass.match(regex)) {

    document.getElementById("phoneErr").innerHTML = `<span style = "color:red">Please enter your correct phone number</span>`
    document.getElementById("register").disabled = true;
  }
  else {

    document.getElementById("phoneErr").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
function ageValid() {
  var pass = document.getElementById("age").value;
  var regex = /^(100|[1-9][0-9]?)$/;
  if (!pass.match(regex)) {

    document.getElementById("ageErr").innerHTML = `<span style = "color:red">Please enter your correct age</span>`
    document.getElementById("register").disabled = true;
  }
  else {

    document.getElementById("ageErr").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
function passwordValid() {
  var pass = document.getElementById("password").value;
  var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
  if (!pass.match(regex)) {

    document.getElementById("PasswordErr").innerHTML = `<span style = "color:red">Please enter a valid password</span>`
    document.getElementById("register").disabled = true;
  }
  else {

    document.getElementById("PasswordErr").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
function passwordMatch() {
  var pass = document.getElementById("password");
  var confPass = document.getElementById("confirm_password");
  if (pass.value != confPass.value) {

    document.getElementById("diffPassword").innerHTML = `<span style = "color:red">Confirm Password is not same as Password</span>`
    document.getElementById("register").disabled = true;
  }
  else {
    document.getElementById("diffPassword").innerHTML = '';
    document.getElementById("register").disabled = false;
  }
}
