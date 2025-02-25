<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send SMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="to">Phone Number</label>
        <input type="text" id="to" name="to" placeholder="Enter phone number (e.g., +1234567890)" required>

        <label for="body">Message</label>
        <textarea id="body" name="body" placeholder="Enter your message" required></textarea>

        <input type="submit" value="Send SMS">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $to = $_POST['to'];
        $body = $_POST['body'];

        // Initialize cURL session
        $ch = curl_init();

        // Set the URL for the POST request
        curl_setopt($ch, CURLOPT_URL, "http://localhost:3000/send-sms");

        // Set the request method to POST
        curl_setopt($ch, CURLOPT_POST, true);

        // Set the POST fields
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['to' => $to, 'body' => $body]));

        // Set options to return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            echo '<div class="message" style="color: red;">Error: ' . curl_error($ch) . '</div>';
        } else {
            // Display the response from the server
            echo '<div class="message" style="color: green;">' . $response . '</div>';
        }

        // Close the cURL session
        curl_close($ch);
    }
    ?>
</body>
</html>
