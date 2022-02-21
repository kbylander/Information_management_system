<?php //Initiating session and making sure the user gets tagged as not logged in.
session_start();
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
} ?>
<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
</style>
    <head>
        <title>Welcome to Genetic Match.com</title>
        <link rel="stylesheet" href="style_calculate.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <img src="../wolf_icon.png" class="logo">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="Links/About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="DbInfo.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="Links/ContactUs.php">Contact Us</a></li>
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
            <div class="input">
                <h2>Choose your algorithm:</h2>
                <form>
                    <select id="country" name="country">
                    <option value="au">Option1</option>
                    <option value="ca">Option2</option>
                    <option value="usa">Option3</option>
                    </select>
                </form>
            <div class="sequence">
                <div class="container">
                    <div>
                        <label>Sequence 1</label>
                        <input type="text" class="textarea" />
                    </div>
                </div>
                <div class="container">
                    <div>
                        <label>Sequence 2</label>
                        <input type="text" class="textarea" />
                    </div>
                </div>
            </div>
            
    </body>
</html>