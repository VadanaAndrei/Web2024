document.getElementById('report_button').addEventListener('click', function () {
    fetch('../checks/check-login-status.php')
        .then(response => response.json())
        .then(data => {
            if (data.loggedIn && data.user_type === 'admin') {
                alert("You can't submit reports as an admin");
            } else {
                window.location.href = 'Report';
            }
        })
        .catch(error => console.error('Error:', error));
});