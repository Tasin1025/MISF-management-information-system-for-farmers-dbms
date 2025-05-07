<?php
require 'db_config.php'; // Include your database configuration file

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['buyer_name'];
    $email = $_POST['buyer_email'];
    $category = $_POST['buyer_category'];
    $contactInfo = $_POST['contact_info'];
    $location = $_POST['location'];
    $password = $_POST['buyer_password'];

    // Insert the buyer data into the database without password hashing
    $sql = "INSERT INTO buyers (name, email, category, contact_info, location, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $category, $contactInfo, $location, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Buyer registration successful!');</script>";
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
    <title>Buyer Registration - MISF</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main>
        <!-- Buyer Registration Form -->
        <section class="registration-form">
            <h2>Sign up as a Buyer</h2>
            <form method="POST">
                <label for="buyer-name">Full Name:</label>
                <input type="text" id="buyer-name" name="buyer_name" placeholder="Enter your name" required>

                <label for="buyer-email">Email:</label>
                <input type="email" id="buyer-email" name="buyer_email" placeholder="Enter your email" required>

                <label for="buyer-password">Password:</label>
                <input type="password" id="buyer-password" name="buyer_password" placeholder="Enter your password">

                <label for="buyer-category">Category of Buyer:</label>
                <select id="buyer-category" name="buyer_category" required>
                    <option value="retail">Retail Buyer</option>
                    <option value="wholesale">Wholesale Buyer</option>
                </select>

                <label for="contact-info">Contact Info:</label>
                <input type="text" id="contact-info" name="contact_info" placeholder="Enter contact number" required>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" placeholder="Enter your location" required>



                <button type="submit">Register</button>
                <a href="index.php">
                    <button type="button">Home</button>
                </a>
            </form>
        </section>
    </main>

    <footer>
        <p>© 2025 Market Information System for Farmers</p>
    </footer>
</body>

</html>