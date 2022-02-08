
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style_reg.css">
</head>
<body>

<form action="performreg.php" method='POST'>

<div>
<h1>Registration Form</h1>
<p>Please fill in this form below:</p>
<hr>
<label><b>Name:</b></label>
<input type="text" placeholder="User Name" name="username" ><br><br>

<label><b>Email:</b></label>
<input type="text" placeholder="Enter Email" name="useremail" ><br><br>

<label><b>Password:</b></label>
<input type="text" placeholder="Enter Password" name="userpassword" required><br><br>
<label><b>Confirm Password:</b></label>
<input type="text" placeholder="Confirm Password" name="confirmpassword" required><br><br>

<label for="Affilitation"><b>Affiliation:</b></label>
<input type="aff" placeholder="Enter your affiliation" name="affiliation" ><br><br>

<div class="elem-group">
    <label for="captcha">Please Enter the Captcha Text</label>
    <img src="captcha.php" alt="CAPTCHA" class="captcha-image"><i class="fas fa-redo refresh-captcha"></i>
    <br>
    <input type="text" id="captcha" name="captcha_challenge" pattern="[A-Z]{6}">
</div>

<button type="submit">Register</button>
<div><button type="button">Cancel</button>

</div></div>
</form>
</body>
</html>