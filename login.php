<?php
session_start();
require_once('connect.php');

if($_SESSION['userSession'] == true){

    header("Location: http://localhost:8090/Subscription%20Service%20Project_PHP%20&%20MySQL/index.php");
    exit;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Uproar</title>
    <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>

<div>
    <nav class="navbar">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">UPROAR</a>
            <ul class="navbar-nav">

                <li class="narbar-login">

                    <a href="login.php">Login</a>

                </li>

            </ul>

        </div>

    </nav>

    <div class="narbar-register">
        <a href="#Register">Don't have a account? Register here.</a>

    </div>
</div>

<div class="loginbox">

    <form method="post"  action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <label for="name" id="login">Login</label><br/>

<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM login_info WHERE username= :username";
    $stmt = $conn->prepare($query);
    $stmt->execute(
        array(

            'username' => $username

        )
    );

    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 1) {

        if ($rows['password'] == $password) {

            $_SESSION['userSession'] = $rows['user_id'];
            header("Location: http://localhost:8090/Subscription%20Service%20Project_PHP%20&%20MySQL/index.php");
            return true;

        } else {

            echo '<p style=" color: red; "> Invalid Credentials</p>';

        }

    } else {
        echo '<p style=" color: red; "> Invalid Credentials</p>';

    };
//test
};

?>

        <input type="text" id="logininput" name="username" placeholder="Username"/><br/>
        <input type="password" id="logininput" name="password" placeholder="Password"/><br/>
        <input type="submit" id="loginbutton" name="submit" value="Submit"/><br/>
        <a href="signup.php">Don't have a account? Sign up here!</a>
    </form>

</div>

</body>
</html>
