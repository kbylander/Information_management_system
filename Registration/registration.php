<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
<head>
<link rel="stylesheet" href="style_reg.css">
</head>
<body>

<div class="LanguageToggle">
                    <div class="GoogleTranslate">
                        <div id="google_translate_element" style="text:right;"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                          new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,de,en,es,it,ja,pt,ru,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                        }
                        </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
                    </div>
<form action="performreg.php" method='POST'>

<div class="sign-up-form">
    <img src="user_färg.png">
    <h1> Please fill in the registration form </h1>
    <input type="name" class="input-box" placeholder="Username" name="username" required>
    <input type="text" class="input-box" placeholder="Enter Email" name="useremail" required>
    <input type="password" class="input-box" placeholder="Enter Password" name="userpassword" required>
    <input type="password" class="input-box" placeholder="Confirm Password" name="confirmpassword" required>
    <input type="text" class="input-box"  placeholder="Enter your affiliation" name="affiliation">
   
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" placeholder="Enter Captcha" pattern="[A-Z]{6}" required>
    <script type="text/javascript">
    var refreshButton = document.querySelector('.refresh-captcha');
    refreshButton.onclick = function() {
    document.querySelector('.captcha-image').src = 'captcha.php?' + Date.now();
    }
    </script>
    <button type="submit" class="register">Register</button>
    <hr>
    <p class=or>OR</p>
    <button id = "b5" onclick="location.href = '../index.php';" type="button" class="cancel">Cancel</button>
</div>
</form>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>
