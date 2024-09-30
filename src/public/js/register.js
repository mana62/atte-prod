document.getElementById('togglePassword1').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

    this.textContent = type === 'password' ? '🙉' : '🙈';
});

document.getElementById('togglePassword2').addEventListener('click', function() {
    const passwordConfirmationInput = document.getElementById('password_confirmation');
    const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordConfirmationInput.setAttribute('type', type);

    this.textContent = type === 'password' ? '🙉' : '🙈';
});