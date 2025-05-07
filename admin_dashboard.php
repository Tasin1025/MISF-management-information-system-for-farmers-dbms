<?php
session_start();
require 'db_config.php'; 

$user_name = $_SESSION['name'];


$sql_farmers_count = "SELECT COUNT(*) AS farmers_count FROM farmers";
$sql_buyers_count = "SELECT COUNT(*) AS buyers_count FROM buyers";
$sql_sellers_count = "SELECT COUNT(*) AS sellers_count FROM sellers";

$result_farmers_count = $conn->query($sql_farmers_count);
$result_buyers_count = $conn->query($sql_buyers_count);
$result_sellers_count = $conn->query($sql_sellers_count);

$farmer_count = $result_farmers_count ? $result_farmers_count->fetch_assoc()['farmers_count'] : 0;
$buyer_count = $result_buyers_count ? $result_buyers_count->fetch_assoc()['buyers_count'] : 0;
$seller_count = $result_sellers_count ? $result_sellers_count->fetch_assoc()['sellers_count'] : 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_feedback'])) {
    $submission_date = $_POST['submission_date'];

    $delete_sql = "DELETE FROM feedback WHERE submission_date = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $submission_date);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback deleted successfully');</script>";
        echo "<script>window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting feedback');</script>";
    }
    $stmt->close();
}


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


$sql_feedback = "SELECT farmers.name, feedback.rating, feedback.comments, feedback.suggestions, feedback.submission_date 
                 FROM feedback 
                 JOIN farmers ON feedback.email = farmers.email";
$result_feedback = $conn->query($sql_feedback);


$sql_farmers = "SELECT id, name, land_size, crops_grown, livestock FROM farmers";
$result_farmers = $conn->query($sql_farmers);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_style.css">
</head>

<body>

    <header class="header">
        <div class="header-left">
            <h1>📋 Admin Dashboard 📋</h1>
        </div>
        <div class="header-right">
            <span>Welcome Admin, <?php echo $user_name ?></span>
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
        </div>
    </header>

    <main class="dashboard">
        <section id="user-management">
            <div class="card">
                <h2>User Management</h2>
                <p>Manage users across different roles:</p>
                <button onclick="location.href='farmers_table.php'">View All Farmers
                    (<?php echo $farmer_count; ?>)</button>
                <button onclick="location.href='buyers_table.php'">View All Buyers
                    (<?php echo $buyer_count; ?>)</button>
                <button onclick="location.href='sellers_table.php'">View All Sellers
                    (<?php echo $seller_count; ?>)</button>
            </div>
        </section>

        <section>
            <h2 class="text-success text-center">Feedback from Farmers</h2>

            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Farmer Name</th>
                            <th>Rating</th>
                            <th>Comments</th>
                            <th>Suggestions</th>
                            <th>Submitted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_feedback && $result_feedback->num_rows > 0) {
                            while ($row = $result_feedback->fetch_assoc()) {
                                echo "<tr>";
                                echo "<form method='POST' action=''>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['rating']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['comments']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['suggestions']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['submission_date']) . "</td>";
                                echo "<td>
                                        <form method='POST' action=''>
                                            <input type='hidden' name='submission_date' value='" . htmlspecialchars($row['submission_date']) . "'>
                                            <button type='submit' name='delete_feedback' class='btn btn-success' onclick=\"return confirm('Are you sure you want to delete this feedback?');\">Clear</button>
                                        </form>
                                      </td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center'>No feedback available</td></tr>";
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