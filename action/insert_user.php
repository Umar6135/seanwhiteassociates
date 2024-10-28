<?php
// Include the database connection file
include '../db/db_connect.php';

// Get form data from POST request and check for null values, assigning "demo" if null
$f_name = !empty($_POST['f_name']) ? $_POST['f_name'] : 'demo';
$l_name = !empty($_POST['l_name']) ? $_POST['l_name'] : 'demo';
$home_address = !empty($_POST['home_address']) ? $_POST['home_address'] : 'demo';
$unit_apartment = !empty($_POST['unit_apartment']) ? $_POST['unit_apartment'] : 'demo';
$zipCode = !empty($_POST['zipCode']) ? $_POST['zipCode'] : 'demo';
$city = !empty($_POST['city']) ? $_POST['city'] : 'demo';
$state = !empty($_POST['state']) ? $_POST['state'] : 'demo';
$phone_number = !empty($_POST['phone']) ? $_POST['phone'] : 'demo';
$email = !empty($_POST['email']) ? $_POST['email'] : 'demo';
$password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : password_hash('demo', PASSWORD_DEFAULT); // Default to 'demo' if no password provided
$package_id = !empty($_POST['package_id']) ? $_POST['package_id'] : 'demo';
$credit_card_number = !empty($_POST['cardNumber']) ? $_POST['cardNumber'] : 'demo';
$expiration_month = !empty($_POST['expMonth']) ? $_POST['expMonth'] : 'demo';
$expiration_year = !empty($_POST['expYear']) ? $_POST['expYear'] : 'demo';
$security_code = !empty($_POST['cvv']) ? $_POST['cvv'] : 'demo';
$transactionId = !empty($_POST['transactionId']) ? $_POST['transactionId'] : 'transactionId'; // Set default value if empty

// Prepare the SQL insert statement, including transaction_id
$sql = "INSERT INTO users (f_name, l_name, home_address, unit_apartment, zipCode, city, state, phone_number, email, password, package_id, credit_card_number, expiration_month, expiration_year, security_code, transaction_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind the statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssisssss", $f_name, $l_name, $home_address, $unit_apartment, $zipCode, $city, $state, $phone_number, $email, $password, $package_id, $credit_card_number, $expiration_month, $expiration_year, $security_code, $transactionId);

// Execute the statement
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
