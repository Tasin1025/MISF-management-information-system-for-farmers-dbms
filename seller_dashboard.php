<?php
session_start();
require 'db_config.php';
$user_name = $_SESSION['name'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_seed'])) {
    $seed_id = $_POST['seed_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    $update_seed_sql = "UPDATE seeds SET name = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($update_seed_sql);
    $stmt->bind_param("sdi", $name, $price, $seed_id);

    if ($stmt->execute()) {
        echo "<script>alert('Seed details updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating seed details');</script>";
    }
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_seed'])) {
    $seed_id = $_POST['seed_id'];

    $delete_seed_sql = "DELETE FROM seeds WHERE id = ?";
    $stmt = $conn->prepare($delete_seed_sql);
    $stmt->bind_param("i", $seed_id);

    if ($stmt->execute()) {
        echo "<script>alert('Seed deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting seed');</script>";
    }
    $stmt->close();
}
$sql_seeds = "SELECT id, name, price FROM seeds";
$result_seeds = $conn->query($sql_seeds);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Page - MISF</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>🏠 Seller Dashboard 🏠</h1>
        </div>
        <div class="header-right">
            <span>Welcome, <?php echo $user_name ?></span>
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
        </div>
    </header>

    <main>

        <section>
            <h2 class="text-success text-center">Seeds</h2>
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
                        if ($result_seeds && $result_seeds->num_rows > 0) {
                            while ($row = $result_seeds->fetch_assoc()) {
                                echo "<tr>";
                                echo "<form method='POST' action=''>";
                                echo "<td><input type='text' name='name' value='" . htmlspecialchars($row['name']) . "' required></td>";
                                echo "<td><input type='number' step='0.01' name='price' value='" . htmlspecialchars($row['price']) . "' required></td>";
                                echo "<td>
                                        <input type='hidden' name='seed_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <button type='submit' name='update_seed' class='btn btn-success'>Update</button>
                                        <button type='submit' name='delete_seed' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this seed?');\">Delete</button>
                                      </td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3' class='text-center'>No seeds found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>


        <section class="add-crop-form">
            <h2>Add Crop Listings</h2>
            <form id="add-crop-form" method="POST" action="add_crop_listing.php">
                <label for="crop-name">Crop Name:</label>
                <input type="text" id="crop-name" name="crop_name" placeholder="Enter crop name" required>

                <label for="crop-price">Price (per unit):</label>
                <input type="number" id="crop-price" name="crop_price" placeholder="Enter price" required>

                <label for="crop-quantity">Available Quantity:</label>
                <input type="number" id="crop-quantity" name="crop_quantity" placeholder="Enter quantity" required>

                <button type="submit">Add Listing</button>
            </form>
        </section>


        <section class="manage-listings">
            <h2>Manage Your Listings</h2>
            <div id="crop-listings">
            </div>
        </section>

        <section class="buyer-inquiries">
            <h2>Buyer Inquiries</h2>
            <div id="buyer-messages">
                <p>No inquiries yet.</p>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Market Information System for Farmers</p>
    </footer>
</body>

</html>