// Get all toggle password buttons
const togglePasswordButtons = document.querySelectorAll('.toggle-password');

togglePasswordButtons.forEach(button => {
    button.addEventListener('click', function () {
        // Find the associated password input
        const passwordInput = this.previousElementSibling;

        // Toggle the type attribute
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.querySelector('i').classList.remove('fa-eye');
            this.querySelector('i').classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            this.querySelector('i').classList.remove('fa-eye-slash');
            this.querySelector('i').classList.add('fa-eye');
        }
    });
});
