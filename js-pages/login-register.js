document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-register');
    const username = document.getElementById('username');
    const email = document.getElementById('e-mail-register');
    const password = document.getElementById('password-register');
    const confirmPassword = document.getElementById('confirm-password-register');

    form.addEventListener('submit', async function (e) {
        e.preventDefault();
        if (await validateInputs()) {
            form.submit();
        }
    });

    [username, email, password, confirmPassword].forEach(input => {
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

    const isValidEmail = email => {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    };

    const validateInputs = async () => {
        const usernameValue = username.value.trim();
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();
        const confirmPasswordValue = confirmPassword.value.trim();
        let isValid = true;

        if (usernameValue === '') {
            setError(username, 'Username cannot be blank');
            isValid = false;
        } else {
            const usernameExists = await checkIfExists('username', usernameValue);
            if (usernameExists) {
                setError(username, 'Username is already taken');
                isValid = false;
            } else {
                setSuccess(username);
            }
        }

        if (emailValue === '') {
            setError(email, 'Email cannot be blank');
            isValid = false;
        } else if (!isValidEmail(emailValue)) {
            setError(email, 'Email is not valid');
            isValid = false;
        } else {
            const emailExists = await checkIfExists('email', emailValue);
            if (emailExists) {
                setError(email, 'Email is already taken');
                isValid = false;
            } else {
                setSuccess(email);
            }
        }

        if (passwordValue === '') {
            setError(password, 'Password cannot be blank');
            isValid = false;
        } else if (passwordValue.length < 8) {
            setError(password, 'Password must be at least 8 characters');
            isValid = false;
        } else if (!/[a-zA-Z]/.test(passwordValue)) {
            setError(password, 'Password must contain at least one letter');
            isValid = false;
        } else if (!/\d/.test(passwordValue)) {
            setError(password, 'Password must contain at least one digit');
            isValid = false;
        } else {
            setSuccess(password);
        }

        if (confirmPasswordValue === '') {
            setError(confirmPassword, 'Confirm Password cannot be blank');
            isValid = false;
        } else if (passwordValue !== confirmPasswordValue) {
            setError(confirmPassword, 'Passwords do not match');
            isValid = false;
        } else {
            setSuccess(confirmPassword);
        }

        return isValid;
    };

    const checkIfExists = async (type, value) => {
        try {
            const response = await fetch('../checks/check-exists.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ type, value })
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            return data.exists;
        } catch (error) {
            console.error('Error:', error);
            return false;
        }
    };
});
