const signupMessage = document.getElementById('signupMessage');
const loginMessage = document.getElementById('loginMessage');
let idSetTimeOutSignUp;
let idSetTimeOutLogin;

if (signupMessage && signupMessage !== null) {
  idSetTimeOutSignUp = setTimeout(() => {
    signupMessage.innerText = '';
  }, 8000);
}
if (loginMessage && loginMessage !== null) {
  idSetTimeOutLogin = setTimeout(() => {
    loginMessage.innerText = '';
  }, 8000);
}

if (typeof idSetTimeOutSignUp !== 'undefined') {
  clearTimeOut(idSetTimeOutSignUp);
}
if (typeof idSetTimeOutLogin !== 'undefined') {
  clearTimeOut(idSetTimeOutLogin);
}
