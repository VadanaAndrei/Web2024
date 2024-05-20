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
    <link rel="stylesheet" href="../css-pages/report_style.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="icon" href="../assets/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="../js-pages/report.js" defer></script>
</head>

<body>
    <header>
        <div class="background">
            <div class="navbar">
                <a class="logo-link" href="Home"><img src="../assets/logo_web.png" alt="FePA" class="navbar__logo"></a>
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
        <div class="container_report">
            <form action="Report/submitReport" method="POST" id="report-form" enctype="multipart/form-data">
                <h2>Report a sighting</h2><br><br>
                <div class="form-group">
                    <label for="species">Species:</label>
                    <select id="species" name="species">
                        <option value="">Select an animal</option>
                        <option value="Aardvark">Aardvark</option>
                        <option value="Albatross">Albatross</option>
                        <option value="Alligator">Alligator</option>
                        <option value="Alpaca">Alpaca</option>
                        <option value="Ant">Ant</option>
                        <option value="Anteater">Anteater</option>
                        <option value="Antelope">Antelope</option>
                        <option value="Ape">Ape</option>
                        <option value="Armadillo">Armadillo</option>
                        <option value="Baboon">Baboon</option>
                        <option value="Badger">Badger</option>
                        <option value="Barracuda">Barracuda</option>
                        <option value="Bat">Bat</option>
                        <option value="Bear">Bear</option>
                        <option value="Beaver">Beaver</option>
                        <option value="Bee">Bee</option>
                        <option value="Bison">Bison</option>
                        <option value="Boar">Boar</option>
                        <option value="Buffalo">Buffalo</option>
                        <option value="Butterfly">Butterfly</option>
                        <option value="Camel">Camel</option>
                        <option value="Capybara">Capybara</option>
                        <option value="Caribou">Caribou</option>
                        <option value="Cassowary">Cassowary</option>
                        <option value="Cat">Cat</option>
                        <option value="Caterpillar">Caterpillar</option>
                        <option value="Cattle">Cattle</option>
                        <option value="Chamois">Chamois</option>
                        <option value="Cheetah">Cheetah</option>
                        <option value="Chicken">Chicken</option>
                        <option value="Chimpanzee">Chimpanzee</option>
                        <option value="Chinchilla">Chinchilla</option>
                        <option value="Chough">Chough</option>
                        <option value="Clam">Clam</option>
                        <option value="Cobra">Cobra</option>
                        <option value="Cockroach">Cockroach</option>
                        <option value="Cod">Cod</option>
                        <option value="Cormorant">Cormorant</option>
                        <option value="Coyote">Coyote</option>
                        <option value="Crab">Crab</option>
                        <option value="Crane">Crane</option>
                        <option value="Crocodile">Crocodile</option>
                        <option value="Crow">Crow</option>
                        <option value="Curlew">Curlew</option>
                        <option value="Deer">Deer</option>
                        <option value="Dinosaur">Dinosaur</option>
                        <option value="Dog">Dog</option>
                        <option value="Dogfish">Dogfish</option>
                        <option value="Dolphin">Dolphin</option>
                        <option value="Donkey">Donkey</option>
                        <option value="Dotterel">Dotterel</option>
                        <option value="Dove">Dove</option>
                        <option value="Dragonfly">Dragonfly</option>
                        <option value="Duck">Duck</option>
                        <option value="Dugong">Dugong</option>
                        <option value="Dunlin">Dunlin</option>
                        <option value="Eagle">Eagle</option>
                        <option value="Echidna">Echidna</option>
                        <option value="Eel">Eel</option>
                        <option value="Eland">Eland</option>
                        <option value="Elephant">Elephant</option>
                        <option value="Elk">Elk</option>
                        <option value="Emu">Emu</option>
                        <option value="Falcon">Falcon</option>
                        <option value="Ferret">Ferret</option>
                        <option value="Finch">Finch</option>
                        <option value="Fish">Fish</option>
                        <option value="Flamingo">Flamingo</option>
                        <option value="Fly">Fly</option>
                        <option value="Fox">Fox</option>
                        <option value="Frog">Frog</option>
                        <option value="Gaur">Gaur</option>
                        <option value="Gazelle">Gazelle</option>
                        <option value="Gerbil">Gerbil</option>
                        <option value="Giraffe">Giraffe</option>
                        <option value="Gnat">Gnat</option>
                        <option value="Gnu">Gnu</option>
                        <option value="Goat">Goat</option>
                        <option value="Goldfinch">Goldfinch</option>
                        <option value="Goldfish">Goldfish</option>
                        <option value="Goose">Goose</option>
                        <option value="Gorilla">Gorilla</option>
                        <option value="Goshawk">Goshawk</option>
                        <option value="Grasshopper">Grasshopper</option>
                        <option value="Grouse">Grouse</option>
                        <option value="Guanaco">Guanaco</option>
                        <option value="Gull">Gull</option>
                        <option value="Hamster">Hamster</option>
                        <option value="Hare">Hare</option>
                        <option value="Hawk">Hawk</option>
                        <option value="Hedgehog">Hedgehog</option>
                        <option value="Heron">Heron</option>
                        <option value="Herring">Herring</option>
                        <option value="Hippopotamus">Hippopotamus</option>
                        <option value="Hornet">Hornet</option>
                        <option value="Horse">Horse</option>
                        <option value="Hummingbird">Hummingbird</option>
                        <option value="Hyena">Hyena</option>
                        <option value="Ibex">Ibex</option>
                        <option value="Ibis">Ibis</option>
                        <option value="Jackal">Jackal</option>
                        <option value="Jaguar">Jaguar</option>
                        <option value="Jay">Jay</option>
                        <option value="Jellyfish">Jellyfish</option>
                        <option value="Kangaroo">Kangaroo</option>
                        <option value="Kingfisher">Kingfisher</option>
                        <option value="Koala">Koala</option>
                        <option value="Kookabura">Kookabura</option>
                        <option value="Kouprey">Kouprey</option>
                        <option value="Kudu">Kudu</option>
                        <option value="Lapwing">Lapwing</option>
                        <option value="Lark">Lark</option>
                        <option value="Lemur">Lemur</option>
                        <option value="Leopard">Leopard</option>
                        <option value="Lion">Lion</option>
                        <option value="Llama">Llama</option>
                        <option value="Lobster">Lobster</option>
                        <option value="Locust">Locust</option>
                        <option value="Loris">Loris</option>
                        <option value="Louse">Louse</option>
                        <option value="Lyrebird">Lyrebird</option>
                        <option value="Magpie">Magpie</option>
                        <option value="Mallard">Mallard</option>
                        <option value="Manatee">Manatee</option>
                        <option value="Mandrill">Mandrill</option>
                        <option value="Mantis">Mantis</option>
                        <option value="Marten">Marten</option>
                        <option value="Meerkat">Meerkat</option>
                        <option value="Mink">Mink</option>
                        <option value="Mole">Mole</option>
                        <option value="Mongoose">Mongoose</option>
                        <option value="Monkey">Monkey</option>
                        <option value="Moose">Moose</option>
                        <option value="Mosquito">Mosquito</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Mule">Mule</option>
                        <option value="Narwhal">Narwhal</option>
                        <option value="Newt">Newt</option>
                        <option value="Nightingale">Nightingale</option>
                        <option value="Octopus">Octopus</option>
                        <option value="Okapi">Okapi</option>
                        <option value="Opossum">Opossum</option>
                        <option value="Oryx">Oryx</option>
                        <option value="Ostrich">Ostrich</option>
                        <option value="Otter">Otter</option>
                        <option value="Owl">Owl</option>
                        <option value="Oyster">Oyster</option>
                        <option value="Panther">Panther</option>
                        <option value="Parrot">Parrot</option>
                        <option value="Partridge">Partridge</option>
                        <option value="Peafowl">Peafowl</option>
                        <option value="Pelican">Pelican</option>
                        <option value="Penguin">Penguin</option>
                        <option value="Pheasant">Pheasant</option>
                        <option value="Pig">Pig</option>
                        <option value="Pigeon">Pigeon</option>
                        <option value="Pony">Pony</option>
                        <option value="Porcupine">Porcupine</option>
                        <option value="Porpoise">Porpoise</option>
                        <option value="Quail">Quail</option>
                        <option value="Quelea">Quelea</option>
                        <option value="Quetzal">Quetzal</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="Raccoon">Raccoon</option>
                        <option value="Rail">Rail</option>
                        <option value="Ram">Ram</option>
                        <option value="Rat">Rat</option>
                        <option value="Raven">Raven</option>
                        <option value="Red deer">Red deer</option>
                        <option value="Red panda">Red panda</option>
                        <option value="Reindeer">Reindeer</option>
                        <option value="Rhinoceros">Rhinoceros</option>
                        <option value="Rook">Rook</option>
                        <option value="Salamander">Salamander</option>
                        <option value="Salmon">Salmon</option>
                        <option value="Sand Dollar">Sand Dollar</option>
                        <option value="Sandpiper">Sandpiper</option>
                        <option value="Sardine">Sardine</option>
                        <option value="Scorpion">Scorpion</option>
                        <option value="Seahorse">Seahorse</option>
                        <option value="Seal">Seal</option>
                        <option value="Shark">Shark</option>
                        <option value="Sheep">Sheep</option>
                        <option value="Shrew">Shrew</option>
                        <option value="Skunk">Skunk</option>
                        <option value="Snail">Snail</option>
                        <option value="Snake">Snake</option>
                        <option value="Sparrow">Sparrow</option>
                        <option value="Spider">Spider</option>
                        <option value="Spoonbill">Spoonbill</option>
                        <option value="Squid">Squid</option>
                        <option value="Squirrel">Squirrel</option>
                        <option value="Starling">Starling</option>
                        <option value="Stingray">Stingray</option>
                        <option value="Stinkbug">Stinkbug</option>
                        <option value="Stork">Stork</option>
                        <option value="Swallow">Swallow</option>
                        <option value="Swan">Swan</option>
                        <option value="Tapir">Tapir</option>
                        <option value="Tarsier">Tarsier</option>
                        <option value="Termite">Termite</option>
                        <option value="Tiger">Tiger</option>
                        <option value="Toad">Toad</option>
                        <option value="Trout">Trout</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turtle">Turtle</option>
                        <option value="Viper">Viper</option>
                        <option value="Vulture">Vulture</option>
                        <option value="Wallaby">Wallaby</option>
                        <option value="Walrus">Walrus</option>
                        <option value="Wasp">Wasp</option>
                        <option value="Weasel">Weasel</option>
                        <option value="Whale">Whale</option>
                        <option value="Wildcat">Wildcat</option>
                        <option value="Wolf">Wolf</option>
                        <option value="Wolverine">Wolverine</option>
                        <option value="Wombat">Wombat</option>
                        <option value="Woodcock">Woodcock</option>
                        <option value="Woodpecker">Woodpecker</option>
                        <option value="Worm">Worm</option>
                        <option value="Wren">Wren</option>
                        <option value="Yak">Yak</option>
                        <option value="Zebra">Zebra</option>
                    </select>
                    <div class="error-text" id="species-error"></div>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" required
                        placeholder="Write a description..."></textarea>
                    <div class="error-text" id="description-error"></div>
                </div>
                <div class="form-group">
                    <label for="tag">Tag:</label>
                    <select id="tag" name="tag">
                        <option value="">Select a tag</option>
                        <option value="Gentle">Gentle</option>
                        <option value="Docile">Docile</option>
                        <option value="Tame">Tame</option>
                        <option value="Peaceful">Peaceful</option>
                        <option value="Relaxed">Relaxed</option>
                        <option value="Fierce">Fierce</option>
                        <option value="Hostile">Hostile</option>
                        <option value="Savage">Savage</option>
                        <option value="Ferocious">Ferocious</option>
                        <option value="Predatory">Predatory</option>
                        <option value="Territorial">Territorial</option>
                        <option value="Timid">Timid</option>
                        <option value="Nervous">Nervous</option>
                        <option value="Anxious">Anxious</option>
                        <option value="Shy">Shy</option>
                        <option value="Fearful">Fearful</option>
                        <option value="Cautious">Cautious</option>
                    </select>
                    <div class="error-text" id="tag-error"></div>
                </div>

                <div class="form-group">
                    <label for="area">Area:</label>
                    <select id="area" name="area" required>
                        <option value="">Select area</option>
                        <option value="park">Park</option>
                        <option value="kindergarten">Kindergarten</option>
                        <option value="school">School</option>
                        <option value="hospital">Hospital</option>
                        <option value="other">Other</option>
                    </select>
                    <div class="error-text" id="area-error"></div>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <select id="country" name="country" required>
                        <option value="">Select country</option>
                        <option value="Afghanistan">Afghanistan</option>
                        <option value="Åland Islands">Åland Islands</option>
                        <option value="Albania">Albania</option>
                        <option value="Algeria">Algeria</option>
                        <option value="American Samoa">American Samoa</option>
                        <option value="Andorra">Andorra</option>
                        <option value="Angola">Angola</option>
                        <option value="Anguilla">Anguilla</option>
                        <option value="Antarctica">Antarctica</option>
                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                        <option value="Argentina">Argentina</option>
                        <option value="Armenia">Armenia</option>
                        <option value="Aruba">Aruba</option>
                        <option value="Australia">Australia</option>
                        <option value="Austria">Austria</option>
                        <option value="Azerbaijan">Azerbaijan</option>
                        <option value="Bahamas">Bahamas</option>
                        <option value="Bahrain">Bahrain</option>
                        <option value="Bangladesh">Bangladesh</option>
                        <option value="Barbados">Barbados</option>
                        <option value="Belarus">Belarus</option>
                        <option value="Belgium">Belgium</option>
                        <option value="Belize">Belize</option>
                        <option value="Benin">Benin</option>
                        <option value="Bermuda">Bermuda</option>
                        <option value="Bhutan">Bhutan</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                        <option value="Botswana">Botswana</option>
                        <option value="Bouvet Island">Bouvet Island</option>
                        <option value="Brazil">Brazil</option>
                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                        <option value="Bulgaria">Bulgaria</option>
                        <option value="Burkina Faso">Burkina Faso</option>
                        <option value="Burundi">Burundi</option>
                        <option value="Cambodia">Cambodia</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Canada">Canada</option>
                        <option value="Cape Verde">Cape Verde</option>
                        <option value="Cayman Islands">Cayman Islands</option>
                        <option value="Central African Republic">Central African Republic</option>
                        <option value="Chad">Chad</option>
                        <option value="Chile">Chile</option>
                        <option value="China">China</option>
                        <option value="Christmas Island">Christmas Island</option>
                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Comoros">Comoros</option>
                        <option value="Congo">Congo</option>
                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The
                        </option>
                        <option value="Cook Islands">Cook Islands</option>
                        <option value="Costa Rica">Costa Rica</option>
                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                        <option value="Croatia">Croatia</option>
                        <option value="Cuba">Cuba</option>
                        <option value="Cyprus">Cyprus</option>
                        <option value="Czech Republic">Czech Republic</option>
                        <option value="Denmark">Denmark</option>
                        <option value="Djibouti">Djibouti</option>
                        <option value="Dominica">Dominica</option>
                        <option value="Dominican Republic">Dominican Republic</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Egypt">Egypt</option>
                        <option value="El Salvador">El Salvador</option>
                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                        <option value="Eritrea">Eritrea</option>
                        <option value="Estonia">Estonia</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                        <option value="Faroe Islands">Faroe Islands</option>
                        <option value="Fiji">Fiji</option>
                        <option value="Finland">Finland</option>
                        <option value="France">France</option>
                        <option value="French Guiana">French Guiana</option>
                        <option value="French Polynesia">French Polynesia</option>
                        <option value="French Southern Territories">French Southern Territories</option>
                        <option value="Gabon">Gabon</option>
                        <option value="Gambia">Gambia</option>
                        <option value="Georgia">Georgia</option>
                        <option value="Germany">Germany</option>
                        <option value="Ghana">Ghana</option>
                        <option value="Gibraltar">Gibraltar</option>
                        <option value="Greece">Greece</option>
                        <option value="Greenland">Greenland</option>
                        <option value="Grenada">Grenada</option>
                        <option value="Guadeloupe">Guadeloupe</option>
                        <option value="Guam">Guam</option>
                        <option value="Guatemala">Guatemala</option>
                        <option value="Guernsey">Guernsey</option>
                        <option value="Guinea">Guinea</option>
                        <option value="Guinea-bissau">Guinea-bissau</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Haiti">Haiti</option>
                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                        <option value="Honduras">Honduras</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Hungary">Hungary</option>
                        <option value="Iceland">Iceland</option>
                        <option value="India">India</option>
                        <option value="Indonesia">Indonesia</option>
                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                        <option value="Iraq">Iraq</option>
                        <option value="Ireland">Ireland</option>
                        <option value="Isle of Man">Isle of Man</option>
                        <option value="Israel">Israel</option>
                        <option value="Italy">Italy</option>
                        <option value="Jamaica">Jamaica</option>
                        <option value="Japan">Japan</option>
                        <option value="Jersey">Jersey</option>
                        <option value="Jordan">Jordan</option>
                        <option value="Kazakhstan">Kazakhstan</option>
                        <option value="Kenya">Kenya</option>
                        <option value="Kiribati">Kiribati</option>
                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of
                        </option>
                        <option value="Korea, Republic of">Korea, Republic of</option>
                        <option value="Kuwait">Kuwait</option>
                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                        <option value="Latvia">Latvia</option>
                        <option value="Lebanon">Lebanon</option>
                        <option value="Lesotho">Lesotho</option>
                        <option value="Liberia">Liberia</option>
                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                        <option value="Liechtenstein">Liechtenstein</option>
                        <option value="Lithuania">Lithuania</option>
                        <option value="Luxembourg">Luxembourg</option>
                        <option value="Macao">Macao</option>
                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav
                            Republic of</option>
                        <option value="Madagascar">Madagascar</option>
                        <option value="Malawi">Malawi</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Maldives">Maldives</option>
                        <option value="Mali">Mali</option>
                        <option value="Malta">Malta</option>
                        <option value="Marshall Islands">Marshall Islands</option>
                        <option value="Martinique">Martinique</option>
                        <option value="Mauritania">Mauritania</option>
                        <option value="Mauritius">Mauritius</option>
                        <option value="Mayotte">Mayotte</option>
                        <option value="Mexico">Mexico</option>
                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                        <option value="Monaco">Monaco</option>
                        <option value="Mongolia">Mongolia</option>
                        <option value="Montenegro">Montenegro</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Myanmar">Myanmar</option>
                        <option value="Namibia">Namibia</option>
                        <option value="Nauru">Nauru</option>
                        <option value="Nepal">Nepal</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                        <option value="New Caledonia">New Caledonia</option>
                        <option value="New Zealand">New Zealand</option>
                        <option value="Nicaragua">Nicaragua</option>
                        <option value="Niger">Niger</option>
                        <option value="Nigeria">Nigeria</option>
                        <option value="Niue">Niue</option>
                        <option value="Norfolk Island">Norfolk Island</option>
                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                        <option value="Norway">Norway</option>
                        <option value="Oman">Oman</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="Palau">Palau</option>
                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                        <option value="Panama">Panama</option>
                        <option value="Papua New Guinea">Papua New Guinea</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Pitcairn">Pitcairn</option>
                        <option value="Poland">Poland</option>
                        <option value="Portugal">Portugal</option>
                        <option value="Puerto Rico">Puerto Rico</option>
                        <option value="Qatar">Qatar</option>
                        <option value="Reunion">Reunion</option>
                        <option value="Romania">Romania</option>
                        <option value="Russian Federation">Russian Federation</option>
                        <option value="Rwanda">Rwanda</option>
                        <option value="Saint Helena">Saint Helena</option>
                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                        <option value="Saint Lucia">Saint Lucia</option>
                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                        <option value="Samoa">Samoa</option>
                        <option value="San Marino">San Marino</option>
                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                        <option value="Senegal">Senegal</option>
                        <option value="Serbia">Serbia</option>
                        <option value="Seychelles">Seychelles</option>
                        <option value="Sierra Leone">Sierra Leone</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Slovakia">Slovakia</option>
                        <option value="Slovenia">Slovenia</option>
                        <option value="Solomon Islands">Solomon Islands</option>
                        <option value="Somalia">Somalia</option>
                        <option value="South Africa">South Africa</option>
                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South
                            Sandwich Islands</option>
                        <option value="Spain">Spain</option>
                        <option value="Sri Lanka">Sri Lanka</option>
                        <option value="Sudan">Sudan</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                        <option value="Swaziland">Swaziland</option>
                        <option value="Sweden">Sweden</option>
                        <option value="Switzerland">Switzerland</option>
                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                        <option value="Taiwan">Taiwan</option>
                        <option value="Tajikistan">Tajikistan</option>
                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Timor-leste">Timor-leste</option>
                        <option value="Togo">Togo</option>
                        <option value="Tokelau">Tokelau</option>
                        <option value="Tonga">Tonga</option>
                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                        <option value="Tunisia">Tunisia</option>
                        <option value="Turkey">Turkey</option>
                        <option value="Turkmenistan">Turkmenistan</option>
                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                        <option value="Tuvalu">Tuvalu</option>
                        <option value="Uganda">Uganda</option>
                        <option value="Ukraine">Ukraine</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="United States">United States</option>
                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands
                        </option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Uzbekistan">Uzbekistan</option>
                        <option value="Vanuatu">Vanuatu</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Viet Nam">Viet Nam</option>
                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                        <option value="Western Sahara">Western Sahara</option>
                        <option value="Yemen">Yemen</option>
                        <option value="Zambia">Zambia</option>
                        <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                    <div class="error-text" id="country-error"></div>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required placeholder="City">
                    <div class="error-text" id="city-error"></div>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required placeholder="Street Address">
                    <div class="error-text" id="address-error"></div>
                </div>
                <div class="form-group">
                    <label for="photos">Photos:</label>
                    <input type="file" id="photos" name="photos[]" accept="image/*" multiple>
                    <div class="error-text" id="photos-error"></div>
                </div>
                <div class="form-group">
                    <label for="additional_info">Additional Information:</label>
                    <textarea id="additional_info" name="additional_info" placeholder="Write something..."></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>

            <div class="image-box">
                <img src="../assets/report-image.png" alt="Report" class="image">
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