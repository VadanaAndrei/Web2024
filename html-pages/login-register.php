<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (isset($_SESSION["user_id"])) {
    header("Location: Profile");
    exit;
}

$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FePA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-pages/login-register_style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js-pages/login-register.js" defer></script>
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
                    <input class="search__input" type="search" name="query" placeholder="Search by species">
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
    <div class="container-login-register">
        <div class="left-column">
            <div class="container-login">
                <form action="LoginRegister/authenticateUser" method="POST" id="form-login">
                    <h2>Login</h2><br><br>
                    <div class="form-group">
                        <label for="e-mail-login">E-mail:</label>
                        <input type="email" id="e-mail-login" name="e-mail" required placeholder="E-mail...">
                    </div>
                    <div class="form-group">
                        <label for="password-login">Password:</label>
                        <input type="password" id="password-login" name="password" required placeholder="Your password...">
                    </div>
                    <?php if (!empty($error_message)): ?>
                        <p class="error-text"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <button type="submit">Login</button>
                    <button type="button" onclick="window.location.href='ForgotPassword';">Forgot password</button>
                </form>
            </div>

            <div class="container-login-admin">
                <form action="LoginRegister/authenticateAdmin" method="POST" id="form-login-admin">
                    <h2>Login as Admin</h2><br><br>
                    <div class="form-group">
                        <label for="username-login-admin">Username:</label>
                        <input type="text" id="username-login-admin" name="username-admin" required placeholder="Username...">
                    </div>
                    <div class="form-group">
                        <label for="password-login-admin">Password:</label>
                        <input type="password" id="password-login-admin" name="password-admin" required placeholder="Your password...">
                    </div>
                    <button type="submit">Login</button>
                </form>
            </div>
        </div>

        <div class="container-register">
            <form action="LoginRegister/register" method="POST" novalidate id="form-register">
                <h2>Register</h2><br><br>
                <div class="form-group">
                    <label for="e-mail-register">E-mail:</label>
                    <input type="email" id="e-mail-register" name="e-mail" required placeholder="Enter your e-mail...">
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required placeholder="Create an username...">
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <label for="password-register">Password:</label>
                    <input type="password" id="password-register" name="password" required placeholder="Create a password...">
                    <div class="error-text"></div>
                </div>
                <div class="form-group">
                    <label for="confirm-password-register">Confirm Password:</label>
                    <input type="password" id="confirm-password-register" name="confirm-password" required placeholder="Confirm your password...">
                    <div class="error-text"></div>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
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
