<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <?php
    if($_POST["message"]){
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
