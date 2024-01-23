<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form data
    if (empty($userName) || empty($email) || empty($password)) {
        // If any of the fields are empty, display an error message
        die('Please fill in all required fields.');
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'mypaint');

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the INSERT statement
    $stmt = $conn->prepare("INSERT INTO registration (userName, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $userName, $email, $password);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "Registration successfully...";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, display a message
    echo "Please submit the form.";
}
?>