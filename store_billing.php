<?php
// store_billing.php

// Database connection parameters
$servername = "localhost"; // replace with your database host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "paintbill"; // replace with your database name

// Create a connection to the database
$conn = new mysqli('localhost', 'root', '', 'paintbill');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zipcode'];

    // SQL query to insert data into the billing_info table
    $sql = "INSERT INTO billing (name, email, address, city, state, zipcode)
            VALUES ('$name', '$email', '$address', '$city', '$state', '$zipcode')";

    if ($conn->query($sql) === TRUE) {
        // Display a success message or redirect the user to another page
        echo "Data saved successfully!";
    } else {
        // Display an error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // Handle invalid requests (e.g., someone accessing the script directly)
    http_response_code(400);
    echo "Invalid request!";
}

// Close the database connection
$conn->close();
?>
