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

// Fetch data from seeds and crops tables
$sql_seeds = "SELECT id, name, price FROM seeds";
$result_seeds = $conn->query($sql_seeds);

$sql_crops = "SELECT id, name, price FROM crops";
$result_crops = $conn->query($sql_crops);
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
            <span>Welcome, <?php echo $user_name; ?></span>
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
    </main>

    <footer>
        <p>&copy; 2025 Market Information System for Farmers</p>
    </footer>
</body>

</html>