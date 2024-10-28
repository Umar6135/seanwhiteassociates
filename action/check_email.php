<?php
// Include the database connection file
include '../db/db_connect.php';


// Get JSON input
$data = json_decode(file_get_contents('php://input'), true);

// Extract email from JSON
$email = $data['email'];

// Prepare SQL query to check if email exists
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Email exists
    echo json_encode(['exists' => true]);
} else {
    // Email does not exist
    echo json_encode(['exists' => false]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
