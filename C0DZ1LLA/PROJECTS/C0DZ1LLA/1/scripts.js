document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("contactForm");
    form.addEventListener("submit", function(event) {
        event.preventDefault();
        if (validateForm()) {
            this.submit();
        }
    });

    function validateForm() {
        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();

        if (name === "" || email === "" || message === "") {
            alert("Please fill in all fields.");
            return false;
        }

        if (!isValidEmail(email)) {
            alert("Please enter a valid email address.");
            return false;
        }

        return true;
    }

    function isValidEmail(email) {
        // Basic email validation regex
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
});
