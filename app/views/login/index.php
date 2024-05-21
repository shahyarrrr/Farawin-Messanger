<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form id="login-form">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">

        <label for="password">Password:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
        <br>
        <span id="showError"></span>
    </form>
<script src="public/js/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#login-form').on('submit', function(e) {
                e.preventDefault(); 
                var username = $("#username").val();
                var password = $("#password").val();

                $.ajax({
                    type: 'POST',
                    url: "<?= URL; ?>login/check_data",
                    data: {
                        username:username,
                        password:password
                    },
                    success: function(response) {
                        response = JSON.parse(response)
                        if (response.status == true) {
                            $("#showError").text(response.message);
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

