<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
    session_start();
    $_SESSION['RegistrationErrors'] = '';
    $email = $_POST["email"];
    include '../Registration/emailsecurity.php'; //This script does the email check
    if(!$isemail){
        $_SESSION['RegistrationErrors'] = $_SESSION['RegistrationErrors'] . 'Email address is not the correct format. '."<br>";//Adds an error message according to the error at hand
      }
    elseif($_POST["message"]){
        mail("daredevilwolves@gmail.com", "Contact", "Name: ". $_POST["name"]. "\n". "Email: ". $_POST["email"]. "\n". "Message: ". $_POST["message"]);
        echo "Email sended successfully.";
    } else {
        echo "Error";
    }
    ?>
    <div class = "buton">
        <button id = "b7" onclick="location.href = 'ContactUs.php';" type="button">Go back</button>
    </div>
</body>
</html>
