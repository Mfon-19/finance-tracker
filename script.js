const signUpModal = document.getElementById("signup-container");
const signUpBtn = document.getElementById("signUpBtn");
const signInBtn = document.getElementById("signInBtn");
const loginContainer = document.getElementById("login-container");

signUpBtn.onclick = () => {
    loginContainer.style.display = "none"
    signUpModal.style.display = "flex"
}

signInBtn.onclick = () => {
    signUpModal.style.display = "none"
    loginContainer.style.display = "flex"
}
