<html>
    <head>
        <style>
            form{
            margin: auto;
            width: fit-content;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            }
        </style>
    </head>
    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="conf-password">Confirm Password:</label>
        <input type="password" id="conf-password" name="conf-password" required><br>
        <input type="submit" value="Register">    
    </form>
</html>

<?php

$registered = true;
$errors = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['conf-password'];
    if ($password == $confirm_password) {
        $password = hash('sha256', $password);
    } else {
        $errors[] = 'password does not match with re-enter password field';
    }
    if (count($errors) > 0) {
        $registered = false;
        foreach ($errors as $error) {
            echo $error;
        }
    }
}



?>