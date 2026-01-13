const passwordInput = document.getElementById('password');
const passwordToggle = document.getElementById('password-toggle');

passwordToggle.addEventListener('click', function() {
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        passwordToggle.classList.remove('fa-eye');
        passwordToggle.classList.add('fa-eye-slash'); // เปลี่ยนเป็นไอคอนตาขีด
    } else {
        passwordInput.type = 'password';
        passwordToggle.classList.remove('fa-eye-slash');
        passwordToggle.classList.add('fa-eye'); // เปลี่ยนเป็นไอคอนตาปกติ
    }
});

function validateRegisterForm() {
    const name = document.getElementById("name").value.trim();
    const surname = document.getElementById("surname").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (!name || !password || !surname || !phone || !email) {
        alert("Please fill out all fields.");
        return false;
    }

    return true; // allow form to submit
}