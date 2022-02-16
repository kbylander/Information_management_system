<?php session_start() ?>
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
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <img src="wolf_icon.png" class="logo">
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

            <div class="content">
                <h1>MAKE YOUR MATCH</h1>
              <?php if ($_SESSION['loggedin']) { //?>
                <p>Welcome <?php echo $_SESSION['user']?>!<p>
                <div>
                <button onclick="location.href = 'DbInfo.php';" type="button"><span></span>DATABASE</button>
              <?php }
              else{ ?>
                <p>With Genetic Match.com we find the perfect fit for you!<p>
                <div>
                  <button onclick="location.href = 'Login/login.php';" type="button"><span></span>DATABASE LOGIN</button>
                  <button onclick="location.href = 'Registration/registration.php';" type="button"><span></span>BECOME A MEMBER</button>
              <?php } ?>
                </div>
            </div>
    </body>
</html>
