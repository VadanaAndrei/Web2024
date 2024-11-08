<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>FePA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-pages/style.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../checks/check-if-admin.js" defer></script>
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
    <div class="container-index">
        <div class="top-section">
            <div class="report">
                <img src="../assets/report.png" alt="Report" class="report__image">
                <button type="button" class="report__button" id="report_button">Report</button>
                <div class="pop-up">Click the 'Report' Button if you encounter a stray animal, or an animal that has escaped
                    from
                    the shelter. Complete the Report Form by entering details about the animal and the sighting location. If
                    possible, upload a photo of the animal. Do not approach or try to capture the animal. Wait for professional
                    help. Your report is crucial in helping to keep both the animal and the community safe. Thank you for your
                    cooperation!</div>
            </div>
            <div class="stats">
                <img src="../assets/stats.png" alt="Statistics" class="stats__image">
                <button type="button" class="stats__button" onclick="window.location.href='Stats';">Statistics</button>
                <div class="pop-up">The 'Statistics' button leads you to a central hub of information regarding feral animal
                    sightings and reports. Designed to keep you informed and aware, this tool is essential for tracking,
                    managing,
                    and understanding the movement of wildlife in urban areas. Engage with our statistics to stay ahead in the
                    shared
                    responsibility of managing our coexistence with feral and wild animals.</div>
            </div>
        </div>
        <div class="bottom-section">
            <div class="latest-reports">
                <h2>Latest reports:</h2>
                <br>
                <?php
                $controller = new Home();
                $controller->latestReports();
                ?>
            </div>
            <div class="tips-and-tricks">
                <h2>How to handle an interaction with an animal:</h2>
                <br>
                <ol>
                    <li>Keep calm: It's important to remain calm and keep your composure when facing a rabid or agitated animal.
                        Avoid sudden movements or loud voices, as these may escalate the situation and cause the animal to become
                        even
                        more aggressive. </li>
                    <li>Avoid direct contact: Try to avoid direct contact with the animal and maintain a safe distance. If the
                        animal is aggressive or out of control, approaching it could expose you to the risk of being bitten or
                        injured.</li>
                    <li>Do not attempt to capture the animal alone: If the animal is out of control and poses a danger, do not
                        try
                        to capture it by yourself. Instead, immediately contact local authorities or an organization specialized
                        in
                        handling wild animals or lost domestic animals.</li>
                    <li>Secure the area: If the animal is in a public area, try to secure the area and warn other individuals
                        about
                        its presence. You can use warning signs or coordinate with local authorities to remove the public from the
                        risky area.</li>
                    <li>Provide information to authorities: If you encounter an animal out of control or rabid, provide precise
                        information to local authorities about the location and behavior of the animal. This will help them to
                        respond
                        appropriately and manage the situation safely</li>
                    <li>Avoid unexpected approaches: If you encounter a wild or agitated animal in the wilderness, avoid
                        unexpected
                        or startling approaches that could provoke an aggressive reaction. Stay at a distance and observe the
                        animal
                        safely.</li>
                    <li>Do not feed or touch the animal: In the case of wild or rabid animals, avoid feeding or touching them.
                        These
                        actions could draw their attention to you and make them become even more aggressive or approach you in
                        search
                        of food.</li>
                </ol>
            </div>
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
