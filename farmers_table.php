<?php
session_start();
require 'db_config.php'; 

$user_name = $_SESSION['name'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_farmer'])) {
    $farmer_id = $_POST['farmer_id'];
    $name = $_POST['name'];
    $land_size = $_POST['land_size'];
    $crops_grown = $_POST['crops_grown'];
    $livestock = $_POST['livestock'];

    $update_sql = "UPDATE farmers SET name = ?, land_size = ?, crops_grown = ?, livestock = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssssi", $name, $land_size, $crops_grown, $livestock, $farmer_id);

    if ($stmt->execute()) {
        echo "<script>alert('Farmer details updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating farmer details');</script>";
    }
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_farmer'])) {
    $farmer_id = $_POST['farmer_id'];

    $delete_sql = "DELETE FROM farmers WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $farmer_id);

    if ($stmt->execute()) {
        echo "<script>alert('Farmer deleted successfully');</script>";
    } else {
        echo "<script>alert('Error deleting farmer');</script>";
    }
    $stmt->close();
}


$sql_farmers = "SELECT id, name, land_size, crops_grown, livestock FROM farmers";
$result_farmers = $conn->query($sql_farmers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Farmers</title>
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>

    <header class="header">
        <div class="header-left">
            <h1>📋 Admin Dashboard 📋</h1>
        </div>
        <div class="header-right">
            <button type="button" onclick="location.href='admin_dashboard.php'">Home</button>
            <span>Welcome Admin, <?php echo $user_name ?></span>
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
        </div>
    </header>




    <main class="dashboard">
        <section>
            <h2 class="text-success text-center">Farmers List</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Farmer Name</th>
                            <th>Land Size</th>
                            <th>Crops Grown</th>
                            <th>Livestock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_farmers && $result_farmers->num_rows > 0) {
                            while ($row = $result_farmers->fetch_assoc()) {
                                echo "<tr>";
                                echo "<form method='POST' action=''>";
                                echo "<td><input type='text' name='name' value='" . htmlspecialchars($row['name']) . "' required></td>";
                                echo "<td><input type='text' name='land_size' value='" . htmlspecialchars($row['land_size']) . "' required></td>";
                                echo "<td><input type='text' name='crops_grown' value='" . htmlspecialchars($row['crops_grown']) . "' required></td>";
                                echo "<td><input type='text' name='livestock' value='" . htmlspecialchars($row['livestock']) . "' required></td>";
                                echo "<td>
                                        <input type='hidden' name='farmer_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <button type='submit' name='update_farmer' class='btn btn-success'>Update</button>
                                        <button type='submit' name='delete_farmer'  class='btn btn-success' onclick=\"return confirm('Are you sure you want to delete this farmer?');\">Delete</button>
                                      </td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No farmers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="text-center p-3 bg-success text-white mt-0">
        <p>&copy; 2025 Market Information System for Farmers</p>
    </footer>

</body>

</html>