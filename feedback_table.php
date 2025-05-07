<?php
session_start();
require 'db_config.php'; 




$user_name = $_SESSION['name'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_feedback'])) {
    $submission_date = $_POST['submission_date'];

    $delete_sql = "DELETE FROM feedback WHERE submission_date = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $submission_date);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback deleted successfully');</script>";
        echo "<script>window.location.href = 'admin_feedback.php';</script>";
    } else {
        echo "<script>alert('Error deleting feedback');</script>";
    }
    $stmt->close();
}


$sql_feedback = "SELECT farmers.name, feedback.rating, feedback.comments, feedback.suggestions, feedback.submission_date 
                 FROM feedback 
                 JOIN farmers ON feedback.email = farmers.email";
$result_feedback = $conn->query($sql_feedback);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Feedback</title>
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
        <p>&copy; 2025 Market Information System for Farmers</p>
    </footer>

</body>

</html>