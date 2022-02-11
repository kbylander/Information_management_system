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

<form action="performreg.php" method='POST'>

<div class="sign-up-form">
    <img src="user_färg.png">
    <h1> Please fill in the registration form </h1>
    <form>  
    <input type="name" class="input-box" placeholder="Username">
    <input type="email" class="input-box" placeholder="Enter Email">
    <input type="password" class="input-box" placeholder="Enter Password" required>
    <input type="password" class="input-box" placeholder="Confirm Password" required>
    <input type="aff" class="input-box" placeholder="Enter your affiliation">
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" placeholder="Enter Captcha" required pattern="[A-Z]{6}">
    
    <script>
    var refreshButton = document.querySelector(".refresh-captcha");
    refreshButton.onclick = function() {
    document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
    }
    </script>
    
    <button type="button" class="register">Register</button>
    <hr>
    <p class=or>OR</p>
    <button id = "b5" onclick="location.href = '../index.php';" type="button" class="cancel">Cancel</button>
    </form>
</div>
</form>
</body>
</html>