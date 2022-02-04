
<!DOCTYPE html>
<html>
<body>

<form action="performreg.php" method='POST' style="border:1px solid #ccc">

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

<button type="submit">Register</button>
<div><button type="button">Cancel</button>

</div></div>
</form>
</body>
</html>