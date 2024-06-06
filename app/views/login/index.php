<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212; /* Dark background color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #1f1f1f; /* Darker form background color */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.1); /* Lighter shadow */
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #ffffff; /* White title text */
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #ffffff; /* White label text */
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 12px);
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #333; /* Darker border color */
            border-radius: 4px;
            background-color: #333; /* Darker input background color */
            color: #ffffff; /* White text color */
        }

        .primary-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .primary-btn:hover {
            background-color: #0056b3;
        }

        #showError {
            color: red;
            font-size: 14px;
        }

        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff; /* Blue link color */
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form id="login-form">
        <h2>Login</h2>
        <a href="<?= URL; ?>register">Don't have an account? Register</a>
        <label for="username">Phone number:</label>
        <input type="text" id="phone" name="username">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <button class="primary-btn" type="submit">Login</button>
        <br>
        <span id="showError"></span>
    </form>
</body>
</html>

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

