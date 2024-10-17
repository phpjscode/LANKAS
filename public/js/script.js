// Toggle Password Visibility for Password Field
document
    .getElementById("togglePassword")
    .addEventListener("click", function () {
        const password = document.getElementById("password");
        const type =
            password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // Toggle Icon Color
        this.querySelector("svg").classList.toggle("text-purple-600");
    });

// Toggle Password Visibility for Confirm Password Field
document
    .getElementById("togglePasswordConfirmation")
    .addEventListener("click", function () {
        const passwordConfirmation = document.getElementById(
            "password_confirmation"
        );
        const type =
            passwordConfirmation.getAttribute("type") === "password"
                ? "text"
                : "password";
        passwordConfirmation.setAttribute("type", type);

        // Toggle Icon Color
        this.querySelector("svg").classList.toggle("text-purple-600");
    });
