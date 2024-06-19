<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FePA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-pages/search-results_style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    <h1>Search Results</h1>

    <?php if (!empty($results)): ?>
        <div class="latest-reports">
            <?php foreach ($results as $report): ?>
                <div class="latest-report-item">
                    <div class="report-info">
                        <h3><?php echo htmlspecialchars($report['species']); ?></h3>
                        <p>Area: <?php echo htmlspecialchars($report['area']); ?></p>
                        <p>Country: <?php echo htmlspecialchars($report['country']); ?></p>
                        <p>City: <?php echo htmlspecialchars($report['city']); ?></p>
                        <p>Address: <?php echo htmlspecialchars($report['address']); ?></p>
                        <p>Description: <?php echo htmlspecialchars($report['description']); ?></p>
                        <p>Submitted at: <?php echo htmlspecialchars($report['submitted_at']); ?></p>
                        <p>Tag: <?php echo htmlspecialchars($report['tags']); ?></p>
                    </div>
                    <div class="photos">
                        <?php
                        $photos = explode(', ', $report['photos']);
                        foreach ($photos as $photo) {
                            echo '<img src="..' . htmlspecialchars($photo) . '" alt="Report Photo">';
                        }
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
    <div class="no_results">
        <p>No results found for your search.</p>
    </div>
    <?php endif; ?>
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
                <a href="https://www.facebook.com/tudor.astancai" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://www.instagram.com/andrei.vadana/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
    <div class="footer__bottom">
        <p>&copy; 2024 FePA. All rights reserved.</p>
    </div>
</footer>

</body>
</html>