<html>
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
}
?>