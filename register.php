<?php

require_once 'php/utils.php';
session_start();
if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']==true){
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/" />
    <link rel="stylesheet" href="/demoeshop/css/main.css">
    <link rel="stylesheet" href="/demoeshop/css/globals.css">
    <link rel="stylesheet" href="/demoeshop/css/forms.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="icon" type="image/png" href="/demoeshop/icons/favicon.ico" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form id="registrationForm">
                <div class="form-group">
                    <h1>Registration</h1>
                </div>
                <div class="errors" id="errors">
                </div>
                <div class="form-group">
                    <input type="text" name="firstname" id="name" autocomplete="firstname" placeholder="First name" onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" required>
                </div>
                <div class="form-group">
                    <input type="text" name="lastname" id="lastname" autocomplete="lastname" placeholder="Last name" onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" autocomplete="email" placeholder="Email" onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" autocomplete="password" placeholder="Password" onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" required>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" autocomplete="confirm-password" placeholder="Confirm Password" onkeydown="if(event.key === 'Enter'){event.preventDefault();register();}" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-secondary" type="button" onclick="register();">Register</button>
                </div>
                <div class="form-group ligther">
                    <p>Already have an acount?</p>
                    <button class="btn btn-primary" type="button" onclick="location.href='login.php'">Login</button>


                </div>
                <div class="form-group">
                    <a class="btn btn-border-none" href="/"> <i class="fas fa-backward"></i>Back</a>
                </div>
            </form>
        </div>
    </div>

    <script src="js/functions.js"></script>
</body>

</html>