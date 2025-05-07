<?php
session_start();
require 'db_config.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT name FROM buyers WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error preparing the SQL query: ' . $conn->error);
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found";
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

// Fetch all crops from the database
$sql_crops = "SELECT id, name, price FROM crops";
$result_crops = $conn->query($sql_crops);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Page - MISF</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>🛒 Buyer Dashboard 🛒</h1>
        </div>
        <div class="header-right">
            <span>Welcome, <?php echo htmlspecialchars($user['name']); ?></span>
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
        </div>
    </header>

    <main>
        <section>
            <h2>Current Crop Prices</h2>
            <p>Here, we gather crops from all over Bangladesh at the lowest prices!</p>
            <table>
                <thead>
                    <tr>
                        <th>Crop Type</th>
                        <th>Price (per kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_crops && $result_crops->num_rows > 0) {
                        while ($row = $result_crops->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['price']) . " ৳</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>No crop data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section class="crop-listings">
            <h2>Available Crops</h2>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search crops by name...">
                <select id="filter-category">
                    <option value="all">All</option>
                    <option value="seeds">Seeds</option>
                    <option value="fertilizers">Fertilizers</option>
                    <option value="equipment">Equipment</option>
                </select>
                <button id="search-button">Search</button>
            </div>
        </section>

        <section class="send-inquiry">
            <h2>Send Inquiry</h2>
            <form id="inquiry-form">
                <label for="crop-name-inquiry">Crop Name:</label>
                <input type="text" id="crop-name-inquiry" placeholder="Enter crop name" required>

                <label for="seller-contact">Seller Contact:</label>
                <input type="text" id="seller-contact" placeholder="Enter seller contact" required>

                <label for="message">Message:</label>
                <textarea id="message" placeholder="Write your inquiry here" required></textarea>

                <button type="submit">Send Inquiry</button>
            </form>
        </section>
    </main>

    <footer>
        <p>© 2025 Market Information System for Farmers</p>
    </footer>
</body>

</html>