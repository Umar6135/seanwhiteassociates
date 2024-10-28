<?php
// send_to_zapier.php

// Get the JSON data from the request body
$requestBody = file_get_contents('php://input');

// Initialize cURL
$ch = curl_init('https://hooks.zapier.com/hooks/catch/20363602/29zvfm6/');

// Set cURL options for POST request
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);

// Execute the request to Zapier and get the response
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    // Return Zapier's response to the client
    header('Content-Type: application/json');
    echo $response;
}

// Close cURL
curl_close($ch);
