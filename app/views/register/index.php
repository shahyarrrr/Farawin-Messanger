<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div class="container">
        <form id="register-form">
            <h2>Register</h2>
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="input-group">
                <label for="password">re-enter Password:</label>
                <input type="password" id="confpassword" name="confpassword">
            </div>
            <button type="submit">Register</button>
            <br>
            <span id="showError"></span>
        </form>
    </div>
<script src="public/js/jquery-3.4.1.min.js"></script>
<script>
    $("#register-form").submit(function(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var confpassword = $("#confpassword").val();

        $.ajax({
            type:"POST",
            url:"<?= URL; ?>register/insert_data",
            data:{
                username:username,
                password:password,
                confpassword:confpassword
            },
            success:function(response) {
                response = JSON.parse(response);
                if (response.status == true) {
                    $("#showError").text(response.message);
                } else {
                    $("#showError").text(response.message);
                }
            },
            error:function() {
                alert("alert");
            }
        })
    });
</script>
</body>
</html>
