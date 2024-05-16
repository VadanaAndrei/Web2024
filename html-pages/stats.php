<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if (!isset($_SESSION["user_id"])) {
    $_SESSION['error_message'] = 'You need to be logged in to access this feature';
    header("Location: ../html-pages/login-register.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FePA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-pages/stats_style.css">
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
                <a class="logo-link" href="home.php"><img src="../assets/logo_web.png" alt="FePA"
                                                          class="navbar__logo"></a>
                <ul class="navbar__buttons">
                    <li><a class="navbar__home" href="home.php">Home</a></li>
                    <li><a class="navbar__about" href="about.php">About</a></li>
                    <li><a class="navbar__contact" href="#contact-id">Contact</a></li>
                    <li><a class="navbar__help" href="help.php">Help</a></li>
                    <li>
                        <div class="search">
                            <span class="search__icon material-symbols-outlined">search</span>
                            <input class="search__input" type="search" placeholder="Search">
                        </div>
                    </li>
                    <li>
                        <a class="profile" href="#" id="profileLink">
                            <span class="material-symbols-outlined">
                                person
                            </span>
                        </a>

                        <script>
                            document.getElementById('profileLink').addEventListener('click', function() {
                                fetch('../php-pages/check-login-status.php')
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.loggedIn) {
                                            window.location.href = '../html-pages/profile.php';
                                        } else {
                                            window.location.href = '../html-pages/login-register.php';
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
        <div class="container_stats">
            <div class="text-box">
                <h1>Statistics</h1>
                <br> <br>
                <p>Users can report observations of stray animals directly through our user-friendly interface. These
                    reports are then processed to create a comprehensive picture of the community's situation and are
                    presented in daily reports, with details on the animals' status (adopted, trained, euthanized),
                    their level of danger, and species.
                    <br> <br>
                    Whether it's about stray dogs needing a home or animals that may
                    pose a risk to residents, our platform ensures that each case is monitored and reported
                    appropriately. Each generated report is available in multiple formats - visually in HTML for easy
                    online access and in PDF format for archiving
                    and printed distribution. This flexibility in presenting data allows users to extract information in
                    the most efficient way for their needs.
                </p>
            </div>
            <section id="statistics">
                <h2>Select filters for statistics</h2>
                <br>
                <form id="filter-form">
                    <div class="form-group">
                        <label for="city-select">City:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <select id="city-select" name="city">
                            <option value="">Select a city</option>
                            <option value="Bucharest">Bucharest</option>
                            <option value="Cluj-Napoca">Cluj-Napoca</option>
                            <option value="Timisoara">Timisoara</option>
                            <option value="Iasi">Iasi</option>
                            <option value="Constanta">Constanta</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="day-input">Day:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="date" id="day-input" name="day">
                    </div>

                    <div class="form-group">
                        <label for="animal-select">Animal:</label>
                        <select id="animal-select" name="animal">
                            <option value="">Select an animal</option>
                            <option value="dog">Dog</option>
                            <option value="cat">Cat</option>
                        </select>
                    </div>
                    <button type="submit">Generate PDF</button>
                    <button type="submit">Generate HTML</button>
                </form>
            </section>
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