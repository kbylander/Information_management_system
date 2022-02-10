<!DOCTYPE html>
<html>
<head>
    <title>Database</title> 
    <link rel="stylesheet" href="../Registration/style_reg.css">
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

<div>
<h1>Login form</h1>
<p>Log in with your credentials:</p>
<hr>

<label><b>Email:</b></label>
<input type="text" placeholder="Enter Email" name="useremail" ><br><br>

<label><b>Password:</b></label>
<input type="password" placeholder="Enter Password" name="userpassword" ><br><br> <!--change to type="password" later-->

<button type="submit">Login</button>
<div><button id = "b2" onclick="location.href = '../index.php';" type="button">Cancel</button>

</div></div>
</form>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>