document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('report-form');
    const species = document.getElementById('species');
    const description = document.getElementById('description');
    const tags = document.getElementById('tags');
    const area = document.getElementById('area');
    const country = document.getElementById('country');
    const city = document.getElementById('city');
    const address = document.getElementById('address');
    const photos = document.getElementById('photos');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const inputs = [species, description, tags, area, country, city, address, photos];

        inputs.forEach(input => {
            validateField({ target: input });
        });

        if (validateInputs()) {
            form.submit();
        }
    });

    [species, description, tags, area, country, city, address, photos].forEach(input => {
        input.addEventListener('input', validateField);
        input.addEventListener('blur', validateField);
    });

    function validateField(event) {
        const input = event.target;
        const value = input.value.trim();
        const errorDisplay = input.parentElement.querySelector('.error-text');

        if (value === '') {
            setError(input, errorDisplay, `Please fill out this field.`);
        } else {
            setSuccess(input, errorDisplay);
        }

        if (input === photos && input.files.length === 0) {
            setError(input, errorDisplay, 'Please upload at least one photo.');
        }
    }

    const setError = (element, errorDisplay, message) => {
        element.parentElement.classList.add('error');
        element.parentElement.classList.remove('success');
        errorDisplay.innerText = message;
    };

    const setSuccess = (element, errorDisplay) => {
        element.parentElement.classList.add('success');
        element.parentElement.classList.remove('error');
        errorDisplay.innerText = '';
    };

    const validateInputs = () => {
        const speciesValue = species.value.trim();
        const descriptionValue = description.value.trim();
        const tagsValue = tags.value.trim();
        const areaValue = area.value.trim();
        const countryValue = country.value.trim();
        const cityValue = city.value.trim();
        const addressValue = address.value.trim();
        const photosFiles = photos.files;
        let isValid = true;

        if (speciesValue === '') {
            setError(species, species.parentElement.querySelector('.error-text'), 'Please select a species.');
            isValid = false;
        } else {
            setSuccess(species, species.parentElement.querySelector('.error-text'));
        }

        if (descriptionValue === '') {
            setError(description, description.parentElement.querySelector('.error-text'), 'Please enter a description.');
            isValid = false;
        } else {
            setSuccess(description, description.parentElement.querySelector('.error-text'));
        }

        if (tagsValue === '') {
            setError(tags, tags.parentElement.querySelector('.error-text'), 'Please select a tag.');
            isValid = false;
        } else {
            setSuccess(tags, tags.parentElement.querySelector('.error-text'));
        }

        if (areaValue === '') {
            setError(area, area.parentElement.querySelector('.error-text'), 'Please select an area.');
            isValid = false;
        } else {
            setSuccess(area, area.parentElement.querySelector('.error-text'));
        }

        if (countryValue === '') {
            setError(country, country.parentElement.querySelector('.error-text'), 'Please select a country.');
            isValid = false;
        } else {
            setSuccess(country, country.parentElement.querySelector('.error-text'));
        }

        if (cityValue === '') {
            setError(city, city.parentElement.querySelector('.error-text'), 'Please enter a city.');
            isValid = false;
        } else {
            setSuccess(city, city.parentElement.querySelector('.error-text'));
        }

        if (addressValue === '') {
            setError(address, address.parentElement.querySelector('.error-text'), 'Please enter an address.');
            isValid = false;
        } else {
            setSuccess(address, address.parentElement.querySelector('.error-text'));
        }

        if (photosFiles.length === 0) {
            setError(photos, photos.parentElement.querySelector('.error-text'), 'Please upload at least one photo.');
            isValid = false;
        } else {
            setSuccess(photos, photos.parentElement.querySelector('.error-text'));
        }

        return isValid;
    };
});
