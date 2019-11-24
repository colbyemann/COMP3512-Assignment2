function openLoginForm() {
	document.querySelector("#login-box").style.display = "block";
	document.querySelector("#signup-box").style.display = "none";
}

function openSignupForm() {
	document.querySelector("#signup-box").style.display = "block";
	document.querySelector("#login-box").style.display = "none";
}

function closeForm() {
	document.querySelector("#login-box").style.display = "none";
	document.querySelector("#signup-box").style.display = "none";
}