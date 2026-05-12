document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("signupForm");
    const emailInput = document.getElementById("email");
    const emailStatus = document.getElementById("email-status");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");

    // C.06: Validate the email using an Ajax request
    emailInput.addEventListener("blur", function() {
        let email = emailInput.value;
        if(email !== "") {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "php/check_email.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if(this.status == 200) {
                    emailStatus.innerHTML = this.responseText;
                }
            };
            xhr.send("email=" + email);
        }
    });

    // C.05: Validate the data in the browser using JavaScript
    form.addEventListener("submit", function(event) {
        if (password.value !== confirmPassword.value) {
            alert("Passwords do not match!");
            event.preventDefault(); // 阻止表单提交
        }
    });
});