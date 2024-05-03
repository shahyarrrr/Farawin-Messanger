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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['conf-password'];
    echo "username : $username <br />";
    echo "password : $password <br />";
    echo "re-enterd password : $confirm_password <br />";
}

?>