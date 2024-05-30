<!DOCTYPE html>
<html>
<head>
    <title>addContact</title>
</head>
<body>
    <form action='addcontact/add' id="addcontact-form">
        <label for="username">Phone number:</label>
        <input type="text" name="phone" id="phone">

        <label for="password">Name:</label>
        <input type="text" name="name" id="name">

        <button type="submit">Add</button>
        <br>
        <span id="showError"></span>
    </form>
<script src="public/js/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addcontact-form').on('submit', function(e) {
                e.preventDefault(); 
                var phone = $("#phone").val();
                var name = $("#name").val();

                $.ajax({
                    type: 'POST',
                    url: "<?= URL; ?>addcontact/add",
                    data: {
                        phone:phone,
                        name:name
                    },
                    success: function(response) {
                        response = JSON.parse(response);
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



