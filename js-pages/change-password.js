document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form');
    const oldPassword = document.getElementById('password');
    const newPassword = document.getElementById('new-password');
    const confirmPassword = document.getElementById('confirm-password');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        const oldPasswordCorrect = await checkOldPassword(oldPassword.value.trim());
        if (await validateInputs(oldPasswordCorrect)) {
            form.submit();
        }
    });

    [oldPassword, newPassword, confirmPassword].forEach(input => {
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

    const validateInputs = async (oldPasswordCorrect) => {
        const oldPasswordValue = oldPassword.value.trim();
        const newPasswordValue = newPassword.value.trim();
        const confirmPasswordValue = confirmPassword.value.trim();
        let isValid = true;

        if (oldPasswordValue === '') {
            setError(oldPassword, 'Old Password cannot be blank');
            isValid = false;
        } else if (oldPasswordCorrect === false) {
            setError(oldPassword, 'Old Password is incorrect');
            isValid = false;
        } else {
            setSuccess(oldPassword);
        }

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

    const checkOldPassword = async (password) => {
        try {
            const response = await fetch('../php-pages/check-old-password.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ password })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            return data.correct;
        } catch (error) {
            console.error('Error:', error);
            return false;
        }
    };
});
