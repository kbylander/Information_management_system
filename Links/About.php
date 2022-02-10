<!DOCTYPE html>
<html>
<head>
    <title>About</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<section class="header">
        <nav>
            <div class ="nav-links">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="../Login/login.php">Database</a></li>
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
<div class = "about">
    <h1 id= "A1"> About </h1>
    <p style= "margin: 25px" >We are a group of 7 students who are coursing "Information Management Systems", which allows us to create a project to improve our society.
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