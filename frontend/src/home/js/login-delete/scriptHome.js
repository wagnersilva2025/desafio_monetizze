function toggleForm() {
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');
    loginForm.classList.toggle('active');
    registerForm.classList.toggle('active');
}

// Mostrar o formulário de login por padrão
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('.login-form');
    loginForm.classList.add('active');
});
