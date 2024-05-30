<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Button Centering</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .button-container {
            text-align: center;
        }
        a {
            text-decoration: none;
        }
        button {
            padding: 10px 20px;
            margin: 5px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #007BFF;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="button-container">
        <a href="https://localhost/Farawin-Messanger/register"><button>Register</button></a>
        <a href="https://localhost/Farawin-Messanger/login"><button>Login</button></a>
    </div>
</body>
</html>
