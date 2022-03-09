<?PHP
session_start();

//Check so the user is logged in, and has access to the database
if(!isset($_SESSION['loggedin'])) {
  $_SESSION['loggedin'] = False;
}
if ($_SESSION['loggedin'] == False) {
  header('Location: ../index.php');
}
//If the user is logged in they will have access to selecti what they want to do
?>

<!DOCTYPE html>
<html>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=Righteous&display=swap');
</style>
    <head>
        <title>Navigation</title>
        <link rel="stylesheet" href="../stylee.css">
    </head>
    <body>
        <div class="banner">
            <div class="navbar">
                <a href= "../index.php"><img src="../wolf_icon.png" class="logo"></a>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Links/About.php">About</a></li>
                    <li><a href="databasemenu.php">Database</a></li>
                    <li><a href="../Links/ContactUs.php">Contact Us</a></li>
                    <li><a href="../Registration/userprofile.php">Profile</a></li>
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
                <div>
                <h1>START YOUR MATCHING</h1>
                <button onclick="location.href = 'Calculate.php';" type="button"><span></span>CALCULATE</button>
                <button onclick="location.href = '../Entryhandling/insertform.php';" type="button"><span></span>UPLOAD</button>
                </div>
                <div>
                <p>BROWSE YOUR DATABASE<p>
                <button onclick="location.href = 'sequencesDB.php';" type="button"><span></span>SEQUENCES</button>
                <button onclick="location.href = 'individualsDB.php';" type="button"><span></span>INDIVIDUALS</button>
                </div>
            </div>
    </body>
</html>
