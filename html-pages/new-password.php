<?php
$token = '';
if (isset($_GET['token'])) {
    $token = $_GET['token']; 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FePA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-pages/new-password_style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js-pages/new-password.js" defer></script>
</head>

<body>
<header>
    <div class="navbar">
        <a class="logo-link" href="Home"><img src="../assets/logo_web.png" alt="FePA" class="navbar__logo"></a>
        <ul class="navbar__buttons">
            <li><a class="navbar__home" href="Home">Home</a></li>
            <li><a class="navbar__about" href="About">About</a></li>
            <li><a class="navbar__contact" href="#contact-id">Contact</a></li>
            <li><a class="navbar__help" href="Help">Help</a></li>
            <li>
                <form class="search" action="SearchResults" method="get">
                    <span class="search__icon material-symbols-outlined">search</span>
                    <input class="search__input" type="search" name="query" placeholder="Search">
                </form>
            </li>
            <li>
                <a class="rss_feed" href="RSS" target="_blank">
                    <span class="material-symbols-outlined">rss_feed</span>
                </a>
            </li>
            <li>
                <a class="profile" href="#" id="profileLink">
            <span class="material-symbols-outlined">
              person
            </span>
                </a>

                <script>
                    document.getElementById('profileLink').addEventListener('click', function () {
                        fetch('../checks/check-login-status.php')
                            .then(response => response.json())
                            .then(data => {
                                if (data.loggedIn) {
                                    if (data.user_type === 'admin') {
                                        window.location.href = 'AdminProfile';
                                    } else {
                                        window.location.href = 'Profile';
                                    }
                                } else {
                                    window.location.href = 'LoginRegister';
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    });
                </script>

            </li>
        </ul>
    </div>
    <div class="background"></div>

</header>

    <main>
        <div class="container-new-password">
            <form action="NewPassword/processResetPassword" method="post" id="form">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                <h2>Change password</h2><br><br>
                <div class="form-group">
                    <label for="password">New Password:</label>
                    <input type="password" id="password" name="password" required
                        placeholder="Enter your new password...">
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm New Password:</label>
                    <input type="password" id="confirm-password" name="confirm-password" required
                        placeholder="Confirm your new password...">
                    <div class="error-text"></div>
                </div>
                <button type="submit">Change password</button>
            </form>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer__contact" id="contact-id">
                <h3>Contact</h3>
                <p>Email: tudorastancai@yahoo.ro</p>
                <p>Phone: +40 712 345 678</p>
            </div>
            <div class="footer__about">
                <h3>About Us</h3>
                <p>Our application is dedicated to reporting stray or escaped animals from shelters.<br>
                    If you encounter such an animal, do not hesitate to report it using our system.</p>
            </div>
            <div class="footer__social-media">
                <h3>Follow Us</h3>
                <p>On social media for the latest updates.</p>
                <div class="social-icons">
                    <a href="https://www.facebook.com/tudor.astancai" target="_blank"><i
                            class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/andrei.vadana/" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <p>&copy; 2024 FePA. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>