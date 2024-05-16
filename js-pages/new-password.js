document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const newPassword = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm-password');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateInputs()) {
            form.submit();
        }
    });

    [newPassword, confirmPassword].forEach(input => {
        input.addEventListener('input', validateField);
        input.addEventListener('blur', validateField);
    });

    function validateField() {
        validateInputs();
    }

    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error-text');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    };

    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error-text');

        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    const validateInputs = () => {
        const newPasswordValue = newPassword.value.trim();
        const confirmPasswordValue = confirmPassword.value.trim();
        let isValid = true;

        if (newPasswordValue === '') {
            setError(newPassword, 'New Password cannot be blank');
            isValid = false;
        } else if (newPasswordValue.length < 8) {
            setError(newPassword, 'Password must be at least 8 characters');
            isValid = false;
        } else if (!/[a-zA-Z]/.test(newPasswordValue)) {
            setError(newPassword, 'Password must contain at least one letter');
            isValid = false;
        } else if (!/\d/.test(newPasswordValue)) {
            setError(newPassword, 'Password must contain at least one digit');
            isValid = false;
        } else {
            setSuccess(newPassword);
        }

        if (confirmPasswordValue === '') {
            setError(confirmPassword, 'Confirm Password cannot be blank');
            isValid = false;
        } else if (newPasswordValue !== confirmPasswordValue) {
            setError(confirmPassword, 'Passwords do not match');
            isValid = false;
        } else {
            setSuccess(confirmPassword);
        }

        return isValid;
    };
});
