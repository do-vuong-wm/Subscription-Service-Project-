<?php
session_start();
require_once('connect.php');

if(isset($_POST['redirect']))
{

    header("Location: http://localhost:8090/Subscription%20Service%20Project_PHP%20&%20MySQL/login.php");
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

<div class="signup">

    <div class="signupform">

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <p class="signuptitle">Signup</p><br>

            <?php

            if (isset($_POST['submit'])){

                // Vars for signup
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $email = $_POST['email'];

                if(!empty($firstname) && !empty($lastname) && !empty($username) && !empty($password) && !empty($email)){


                    $getLogin = 'SELECT * FROM login_info WHERE username = :username AND email = :email';
                    $stmt = $conn->prepare($getLogin);
                    $stmt->execute(

                        array(
                            "username" => $username,
                            "email" => $email
                        )
                    );
                    $loginInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($loginInfo['username'] != $username && $loginInfo['email'] != $email) {

                        $getLogin = 'SELECT * FROM login_info WHERE username = :username';
                        $stmt = $conn->prepare($getLogin);
                        $stmt->execute(

                            array(
                                "username" => $username
                            )
                        );
                        $loginInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                        if($loginInfo['username'] != $username) {

                            $getLogin = 'SELECT * FROM login_info WHERE email = :email';
                            $stmt = $conn->prepare($getLogin);
                            $stmt->execute(

                                array(
                                    "email" => $email
                                )
                            );
                            $loginInfo = $stmt->fetch(PDO::FETCH_ASSOC);

                            if($loginInfo['email'] != $email) {


                                $query = 'INSERT INTO login_info VALUES (0, :username, :password, :email, "Not Verified")';

                                $query2 = 'INSERT INTO users_info VALUES (0, :firstname, :lastname, NULL, NULL)';

                                $stmt = $conn->prepare($query);
                                $stmt2 = $conn->prepare($query2);

                                $stmt->execute(
                                    array(

                                        'username' => $username,
                                        'password' => $password,
                                        'email' => $email

                                    )
                                );

                                $stmt2->execute(
                                    array(
                                        'firstname' => $firstname,
                                        'lastname' => $lastname

                                    )
                                );

                                echo '<p style="color: blue;">You are now signed up!</p>';
                                $check = true;

                            }else{

                                echo '<p style="color: red;">Email taken!</p>';

                            }

                        }else{

                            echo '<p style="color: red;">Username taken!</p>';

                        }

                    }else{

                        $une = true;
                        echo '<p style="color: red;">Username and Email taken!!</p>';

                    }

                }else{

                    echo '<p style="color: red;">Please fill it all out!</p>';

                }

            }
            ?>

            <label for="firstname" id="signuplabel">First Name:</label><br/>
            <input type="text" id="signupinput" name="firstname"/><br/>
            <label for="lastname" id="signuplabel">Last Name:</label><br/>
            <input type="text" id="signupinput" name="lastname"/><br/>
            <label for="username" id="signuplabel">Username:</label><br/>
            <input type="text" id="signupinput" name="username"/><br/>
            <label for="password" id="signuplabel">Password:</label><br/>
            <input type="password" id="signupinput" name="password"/><br/>
            <label for="email" id="signuplabel">Email:</label><br/>
            <input type="email" id="signupinput" name="email"/><br/>
            <input type="submit" id="signupbutton" name="submit" value="Submit"/>
            <?php

            if($check == true){

                echo '<input type="submit" id="signupbutton" name="redirect" value="Go to login page"/>';

            }

            ?>
        </form>

    </div>

</div>

</body>
</html>
