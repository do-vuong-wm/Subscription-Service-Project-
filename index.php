<?php
session_start();
require_once('connect.php');

if(($_SESSION['userSession']) == true ) {

    $query = "SELECT * FROM login_info WHERE user_id = :userid";
    $stmt = $conn->prepare($query);
    $stmt->execute(array(":userid" => $_SESSION['userSession']));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uproar</title>
    <link type="text/css" rel="stylesheet" href="style.css">
    <link t
</head>
<body>

<div>
    <nav class="navbar">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">UPROAR</a>

            <ul class="navbar-nav">

                <li class="narbar-login">

                    <a href="login.php"><?php if($_SESSION['userSession'] == false){ echo "Login"; }else{ echo $rows['email']; ?></a><?php echo " /"; }?><br/>
                    <a href="logout.php"><?php if($_SESSION['userSession'] == false){ echo ""; }else{ echo 'logout'; } ?></a>

                </li>

            </ul>

        </div>

    </nav>

    <div style="margin: 20px">

        <p style="font-size: 40px; color: red; text-align: center; font-family: 'Impact'">GET PROTEIN DELIVERED AT UPROAR</p>

    </div>

    <div class="slide">

        <img class="slides" src="Untitled-1%20copy.png">
        <img class="slides" src="Untitled-1.png">

    </div>

    <script src="script.js"></script>

</div>

</body>
</html>
