<?php
require 'db_config.php'; // Include your database configuration file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['seller_name'];
    $email = $_POST['seller_email'];
    $password = $_POST['seller_password'];
    $contact = $_POST['contact'];
    $location = $_POST['location'];
    $inputs = $_POST['inputs'];

    // Insert the seller data into the database
    $sql = "INSERT INTO sellers (name, email, password, contact, location, inputs) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $password, $contact, $location, $inputs);

    if ($stmt->execute()) {
        echo "<script>alert('Seller registration successful!');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration - MISF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main>
        <!-- Seller Registration Form -->
        <section class="registration-form">
            <h2>Register as a Seller</h2>
            <form method="POST" action="">
                <label for="seller-name">Seller Name:</label>
                <input type="text" id="seller-name" name="seller_name" placeholder="Enter your name" required>

                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="contact" placeholder="Enter contact number" required>

                <label for="seller-email">Email:</label>
                <input type="email" id="seller-email" name="seller_email" placeholder="Enter your email" required>

                <label for="seller-password">Password:</label>
                <input type="password" id="seller-password" name="seller_password" placeholder="Enter your password" required>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" placeholder="Enter your location" required>

                <label for="inputs">Inputs Provided:</label>
                <textarea id="inputs" name="inputs" placeholder="List your inputs (e.g., seeds, fertilizers)" required></textarea>

                <button type="submit">Register</button>
                <a href="index.php">
                    <button type="button">Home</button>
                </a>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Market Information System for Farmers</p>
    </footer>
</body>
</html>
