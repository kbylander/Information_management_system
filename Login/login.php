<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
<head>
    <link rel="stylesheet" href="style_login.css">
</head>
<body>
<section class="header">
        <nav>
            <div class ="nav-links">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <li><a href="#">Database</a></li>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                </ul>
            </div>
        </nav>
    <div class="LanguageToggle">
                    <div class="GoogleTranslate">
                        <div id="google_translate_element" style="text:right;"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                          new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ar,de,en,es,it,ja,pt,ru,zh-CN,zh-TW', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                        }
                        </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
    </div>
</section>

<form action="conflogin.php" method='POST'>
<div class="log-in-form">
<img align="left" src="login.png">
<h1>Login</h1>
<input type="text" class="input-box" placeholder="Enter Email" name="useremail" required>
<input type="password" class="input-box" placeholder="Enter Password" name="userpassword" required>
<button type="submit" class="login">Login</button>
<div class="signup_link">
    Not a member? <a href="../Registration/registration.php">Signup</a>
</div>
</div>
</form>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>