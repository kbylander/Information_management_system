<!DOCTYPE html>
<html>
<head>
    <title>Genetic Match.com</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="header">
        <nav>
            <div class ="nav-links">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="About.php">About</a></li>
                    <li><a href="DbInfo.php">Database</a></li>
                    <li><a href="ContactUs.php">Contact Us</a></li>
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
<main>
<div class = "center">
        <h1 id= "t1"> Welcome to Genetic Match.com </h1>
        <div class = "centerbuttoms">
            <button id = "b1" onclick="location.href = 'dblogin.php';" type="button">Database Login</button>
            <button id = "b2" onclick="location.href = 'member.php';" type="button">Become a member</button>
        </div>
</div>
</main>
<footer>
    <p>©Copyright 2022 by Daredevils. All rights reversed.</p>
</footer>
</body>
</html>