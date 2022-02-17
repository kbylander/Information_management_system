<?php //Initiating session and making sure the user gets tagged as not logged in.
session_start();
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
} ?>
<!DOCTYPE html>
<html>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');
</style>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
<div class="banner">
            <div class="navbar">
                <img src="../wolf_icon.png" class="logo">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="DbInfo.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="../Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="#">Contact Us</a></li>
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
<div class = "contact">
    <h1 id= "B1"> Contact Us </h1>
    <div class = "info">
        <div class = "r0">
            <p style= "margin: 25px" >Genetic Match.dom</p>
            <p style= "margin: 25px" >Informationsteknologiskt centrum (ITC),</p>
            <p style= "margin: 25px" >Lägerhyddsvägen 2, 752 37 Uppsala</p>
        </div>
        <div class = "r1">
            <p style= "margin: 25px" >Tel: (879) 769-0684</p>
            <p style= "margin: 25px" >Fax: (879) 769-1267</p>
            <p style= "margin: 25px" >Email: geneticmatch@geneticmatch.org </p>
        </div>
    </div>
    <div class = "form">
        <h1 id= "C1"> Form </h1>
        <form action="subscriberform.php" method="POST">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br>
            <label for="message">Message:</label><br>
            <textarea rows="2" cols="25" placeholder="This is the default text" id="message" name="message" style="height:150px; width: 500px;"></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</div>
<div class = "maps">
    <h1 id= "D1"> Localization </h1>
    <iframe title="Google Map" src="https://maps.google.com/maps?q=polacksbacken&t=&z=13&ie=UTF8&iwloc=&output=embed" width="1000" height="600" frameborder="0" style="border:0" allowfullscreen=""></iframe>
</div>
</main>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>