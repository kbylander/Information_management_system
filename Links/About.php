<?php //Initiating session and making sure the user gets tagged as not logged in.
session_start();
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
} ?>
<!DOCTYPE html>
<html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
</style>
<head>
    <title>About</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="../Database/databasemenu.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="../Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="ContactUs.php">Contact Us</a></li>
                    <li><a href="../Registration/userprofile.php">Profile</a></li>
                </ul>
            </div>

            <div class="LanguageToggle">
                    <div class="GoogleTranslate">
                        <div id="google_translate_element" style="text:right;"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                          new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,de,en,es,it,ja,pt,ru,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                        }
                        </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
            </div>
<main>
<div class = "about">
    <h1 id= "A1"> About </h1>
    <p id= "t1" style= "margin: 25px"  >We are a group of 7 students who are coursing "Information Management Systems" at Uppsala University, which allows us to create a project to improve our society.
        There exists an important problem in the Scandinavian wolf population: inbreeding.
        As the Scandinavian wolf population was founded in the 1980s by only two individuals, this population has grown in isolation, which has led to genetic problems through generations and is considered a long-term threat to the population.
        There are a limited number of available systems for calculating genetic distances. And those available are often limited to genetic distances between populations, such as the online calculator made by John Brzustowski, rather than between individuals
        Our project focus on investigating how well individuals are genetically compatible in order to avoid genetic inbreeding in this population, and, in the future, be able to extend to more species.</p>
        <div class = "contact">
        <button id = "b3" onclick="location.href = 'ContactUs.php';" type="button">
            <div class="containerphoto">
                <img class = "email" src="email.jpg">
            </div>
            <h3 style= "margin: 5px">Contact us</h3>
            <p style= "margin: 5px">More questions? Write to us. We are here to help :)</p></button>
        </div>
</div>
</main>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>