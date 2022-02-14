<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
    if($_POST["message"]){
        mail("paula.camargo.romera@gmail.com", "Contact", $_POST["message"]. $_POST["email"]);
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
