<?php
    $email = $_POST['email'];

    // Check if the password index exists in the $_POST array
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        echo "<h2>Please fill in the password field.</h2>";
        exit();
    }

    // Database
    $con = new mysqli("localhost", "root", "", "mypaint");
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                // Redirect after successful login
                header("Location: loginafter.html"); // Change 'dashboard.php' to the desired page
                exit(); // Make sure to exit after redirecting
            } else {
                echo "<h2>Invalid Email or password</h2>";
            }
        } else {
            echo "<h2>Invalid Email or password</h2>";
        }
    }
?>