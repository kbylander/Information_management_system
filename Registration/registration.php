<?php session_start()?>
<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
<head>
<link rel="stylesheet" href="registration_styles.css?ts=<?time()?>">
</head>
<body>
<div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <?php if ($_SESSION['loggedin']) { //If logged in, take the user to the database?>
                    <li><a href="DbInfo.php">Database</a></li>
                    <?php }
                    else{ //If not logged in, take the user to the login page?>
                    <li><a href="../Login/login.php">Database</a></li>
                    <?php } ?>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
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
</div>
<main>
<form action="performreg.php" method='POST'>

<div class="sign-up-form">
    <h1> Please fill in the registration form </h1>
    <?php if (isset($_SESSION['RegistrationErrors'])): ?>
      <div class="form-errors">
        <p><?php echo $_SESSION['RegistrationErrors']?></p>
        <?php $_SESSION['RegistrationErrors'] = ''?>
      </div>
    <?php endif; ?>
    <input type="name" class="input-box" placeholder="Username" name="username" required>
    <input type="text" class="input-box" placeholder="Enter Email" name="useremail" required>
    <input type="password" class="input-box" placeholder="Enter Password" name="userpassword" required>
    <input type="password" class="input-box" placeholder="Confirm Password" name="confirmpassword" required>
    <hr>
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" placeholder="Enter Captcha" pattern="[0-9]{5}" required>
    <script type="text/javascript">
    var refreshButton = document.querySelector('.refresh-captcha');
    refreshButton.onclick = function() {
    document.querySelector('.captcha-image').src = 'captcha.php?' + Date.now();
    }
    </script>
    <button type="submit" class="register"><span></span>REGISTER</button>
    <button id = "b5" onclick="location.href = '../index.php';" type="button" class="cancel"><span></span>CANCEL</button>
</div>
</form>
</main>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>
