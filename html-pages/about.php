<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>FePA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css-pages/about_style.css">
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
    <div class="container_about">
      <div class="text-box">
        <h1>About Us</h1>
        <br>
        Our system is focused on helping people be aware of lost or escaped animals around them. Whether
        it's a neighborhood dog or a more unusual animal, every report you make can make a difference.
        <br> <br>
        <h4>How to Report</h4>
        <br>
        Spot a stray? Don't hesitate. Use our web service to quickly report it. Upload photos, provide a simple
        description, and choose tags that best describe the situation. Whether it's noting that an animal has left its
        shelter or seems in distress, your report is valuable.
        <br> <br>
        <h4>News and Updates</h4>
        <br>
        Keep up with the latest reports with our RSS news feed. Each new report is added, keeping you informed about
        what's
        happening around you.
        <br> <br>
        Join us in creating a safer community for both people and animals. Report your sightings today!
      </div>
      <div class="image-box">
        <img src="../assets/about.jpg" alt="About Us" class="image">
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