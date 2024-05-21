<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION["user_id"])) {
    $_SESSION['error_message'] = 'You need to be logged in to access this feature';
    header("Location: LoginRegister");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FePA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-pages/profile_style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<header>
    <div class="background">
        <div class="navbar">
            <a class="logo-link" href="Home"><img src="../assets/logo_web.png" alt="FePA"
                                                  class="navbar__logo"></a>
            <ul class="navbar__buttons">
                <li><a class="navbar__home" href="Home">Home</a></li>
                <li><a class="navbar__about" href="About">About</a></li>
                <li><a class="navbar__contact" href="#contact-id">Contact</a></li>
                <li><a class="navbar__help" href="Help">Help</a></li>
                <li>
                    <div class="search">
                        <span class="search__icon material-symbols-outlined">search</span>
                        <input class="search__input" type="search" placeholder="Search">
                    </div>
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
                        document.getElementById('profileLink').addEventListener('click', function() {
                            fetch('../checks/check-login-status.php')
                                .then(response => response.json())
                                .then(data => {
                                    if (data.loggedIn) {
                                        window.location.href = 'Profile';
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
    </div>

</header>

    <main>
        <div class="container-profile">
            <div class="text-box">
                <span class="material-symbols-outlined">person</span>
                <h1>Profile</h1>
                <br>
                <p>Username: <span id="username">Loading...</span></p>
                <br>
                <p>E-mail: <span id="email">Loading...</span></p>
            </div>
            <div class="buttons-container">
                <button onclick="location.href='LoginRegister/logout'" type="submit">Logout</button>
                <button type="button" onclick="window.location.href='ChangePassword';">Change password</button>
            </div>

            <script>
                function fetchUserData() {
                    fetch('../checks/get-user-info.php')
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('username').textContent = data.username;
                            document.getElementById('email').textContent = data.email;
                        })
                        .catch(error => console.error('Error fetching data:', error));
                }
        
                window.onload = fetchUserData;
            </script>

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