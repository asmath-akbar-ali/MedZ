<?php
// Define the recipient's phone number and message
$to = '+918072379779'; // Replace with the recipient's phone number
$body = 'Hello, this is a test message!'; // Replace with your message

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
    echo 'Error: ' . curl_error($ch);
} else {
    // Print the response from the server
    echo $response;
}

// Close the cURL session
curl_close($ch);
?>
