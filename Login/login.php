<?PHP session_start()?>
<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@700&display=swap%27');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap%27');
</style>
<head>
    <link rel="stylesheet" href="login_style.css">
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
<form action="conflogin.php" method='POST'>
<div class="log-in-form">
<img align="left" src="login.png">
<h1>Login</h1>

<?PHP if(isset($_SESSION['LoginError'])): ?>
<div class='form-errors'>
<p> <?php echo $_SESSION['LoginError'] ?> </p>
<?PHP $_SESSION['LoginError'] = ''; ?> </p>
</div>
<?php endif; ?>

<input type="text" class="input-box" placeholder="Enter Username" name="username" required>
<input type="password" class="input-box" placeholder="Enter Password" name="userpassword" required>
<button type="submit" class="login"><span></span>LOGIN</button>
<hr>
<p class=or>OR</p>
<button onclick="location.href = '../index.php';" type="button" class="cancel"><span></span>CANCEL</button>
<div class="signup_link">
    Not a member? <a href="../Registration/registration.php">Signup</a>
</div>
</div>
</form>
</main>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reserved.</p>
</footer>
</body>
</html>
