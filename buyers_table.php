<?php
session_start();
require 'db_config.php'; // Database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if user is not logged in
    header("Location: login.php");
    exit;
}

// Fetch the user information from the database
$user_name = $_SESSION['name'];

// Handle deletion of buyer
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_buyer'])) {
    $buyer_id = $_POST['buyer_id'];

    $delete_sql = "DELETE FROM buyers WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $buyer_id);

    if ($stmt->execute()) {
        echo "<script>alert('Buyer deleted successfully');</script>";
        echo "<script>window.location.href = 'admin_buyers.php';</script>";
    } else {
        echo "<script>alert('Error deleting buyer');</script>";
    }
    $stmt->close();
}

// Fetch all buyers from the database
$sql_buyers = "SELECT id, name, category, contact_info, location FROM buyers";
$result_buyers = $conn->query($sql_buyers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Buyers</title>
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
            <h2 class="text-success text-center">Buyers List</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Buyer Name</th>
                            <th>Category</th>
                            <th>Contact Info</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_buyers && $result_buyers->num_rows > 0) {
                            while ($row = $result_buyers->fetch_assoc()) {
                                echo "<tr>";
                                echo "<form method='POST' action=''>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['category']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['contact_info']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['location']) . "</td>";
                                echo "<td>
                                       
                                            <input type='hidden' name='buyer_id' value='" . htmlspecialchars($row['id']) . "'>
                                            <button type='submit' name='delete_buyer' class='btn btn-danger' onclick=\"return confirm('Are you sure you want to delete this buyer?');\">Delete</button>
                                      </td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>No buyers found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer class="text-center p-3 bg-success text-white mt-0">
        <p>© 2025 Market Information System for Farmers</p>
    </footer>

</body>

</html>