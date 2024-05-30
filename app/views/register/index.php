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
                <label for="username">Phone number:</label>
                <input type="text" id="phone" name="username">
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
        <a href="<?= URL; ?>login">Login</a>
    </div>
<script src="public/js/jquery-3.4.1.min.js"></script>
<script>
    $("#register-form").submit(function(e) {
        e.preventDefault();
        var phone = $("#phone").val();
        var password = $("#password").val();
        var confpassword = $("#confpassword").val();

        $.ajax({
            type:"POST",
            url:"<?= URL; ?>register/insert_data",
            data:{
                phone:phone,
                password:password,
                confpassword:confpassword
            },
            success:function(response) {
                response = JSON.parse(response);
                if (response.status == true) {
                    $("#showError").text(response.message);
                    window.location = "<?= URL; ?>login";
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
