<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form id="login-form">
        <label for="username">Phone number:</label>
        <input type="text" name="username" id="phone">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
        <br>
        <span id="showError"></span>
    </form>
    <a href="<?= URL; ?>register">Register</a>
<script src="public/js/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault(); 
                var phone = $("#phone").val();
                var password = $("#password").val();

                $.ajax({
                    type: 'POST',
                    url: "<?= URL; ?>login/check_data",
                    data: {
                        phone:phone,
                        password:password
                    },
                    success: function(response) {
                        response = JSON.parse(response)
                        if (response.status == true) {
                            $("#showError").text(response.message);
                            window.location = "<?= URL; ?>";
                        } else {
                            $("#showError").text(response.message);
                        }
                    },
                    error: function() {
                        alert("alert!");
                    }
                });
            });
        });
    </script>
</body>
</html>

