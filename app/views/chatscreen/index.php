<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Screen</title>
    <style>
        body, html {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
    height: 100%;
}

.chat-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
    border: 1px solid #ccc;
}

.chat-header {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
    text-align: center;
}

.chat-body {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background-color: #f4f4f4;
}

.message {
    margin-bottom: 20px;
}

.message p {
    margin: 0;
    padding: 10px;
    border-radius: 5px;
    max-width: 70%;
}

.message.received p {
    background-color: #e5e5e5;
    align-self: flex-start;
}

.message.sent p {
    background-color: #4CAF50;
    color: white;
    align-self: flex-end;
}

.timestamp {
    display: block;
    font-size: 12px;
    color: #888;
    margin-top: 5px;
}

.chat-footer {
    display: flex;
    padding: 10px;
    background-color: #ddd;
}

.chat-footer input[type="text"] {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
}

.chat-footer button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
}

.chat-footer button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <div class="chat-container">
        <!-- Header -->
        <div class="chat-header">
            <h2>Chat Header</h2>
        </div>
        
        <!-- Chat Body -->
        <div class="chat-body">
            <div class="message received">
                <p>Hi there!</p>
                <span class="timestamp">10:00 AM</span>
            </div>
            <div class="message sent">
                <p>Hello!</p>
                <span class="timestamp">10:01 AM</span>
            </div>
            <!-- More messages here -->
        </div>
        
        <!-- Footer -->
        <div class="chat-footer">
            <input type="text" placeholder="Type a message..." />
            <button type="button">Send</button>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
