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
    // header("Location: login.php");
    // exit();
    
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_crop'])) {
    $crop_id = $_POST['crop_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $update_crop_sql = "UPDATE crops SET name = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($update_crop_sql);
    $stmt->bind_param("sdi", $name, $price, $crop_id);

    if ($stmt->execute()) {
        echo "<script>alert('Crop details updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating crop details');</script>";
    }
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_crop'])) {
    $crop_id = $_POST['crop_id'];

    $delete_crop_sql = "DELETE FROM crops WHERE id = ?";
    $stmt = $conn->prepare($delete_crop_sql);
    $stmt->bind_param("i", $crop_id);

    if ($stmt->execute()) {
        echo "<script>alert('Crop deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting crop');</script>";
    }
    $stmt->close();
}
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
            <h2 class="text-success text-center">Crops</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_crops && $result_crops->num_rows > 0) {
                            while ($row = $result_crops->fetch_assoc()) {
                                echo "<tr>";
                                echo "<form method='POST' action=''>";
                                echo "<td><input type='text' name='name' value='" . htmlspecialchars($row['name']) . "' required></td>";
                                echo "<td><input type='number' step='0.01' name='price' value='" . htmlspecialchars($row['price']) . "' required></td>";
                                echo "<td>
                                        <input type='hidden' name='crop_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <button type='submit' name='update_crop' class='btn btn-success'>Update</button>
                                        <button type='submit' name='delete_crop' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this crop?');\">Delete</button>
                                      </td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>No crops found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
            <!-- Dynamic crop listings will appear here -->
        </section>

        <!-- Inquiry Section -->
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
        <p>&copy; 2024 Market Information System for Farmers</p>
    </footer>
</body>

</html>