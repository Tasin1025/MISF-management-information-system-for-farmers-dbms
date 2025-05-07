<?php
session_start();
require 'db_config.php'; 

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM farmers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$email = $user['email'];
$name = $user['name'];   

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rating = intval($_POST['rating']);
    $comments = $_POST['comments'];
    $suggestions = $_POST['suggestions'];

   
    $sql = "INSERT INTO feedback (email, name, rating, comments, suggestions) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $email, $name, $rating, $comments, $suggestions);

    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}


$sql = "SELECT feedback.*, farmers.name AS farmer_name 
        FROM feedback
        JOIN farmers ON feedback.email = farmers.email";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header">
        <h1>📝 Submit Feedback 📝</h1>
    </header>

    <nav class="menu-card">
        <ul>
            <li><a href="farmer_dashboard.php">Home</a></li>
            <li><a href="farmers_guide.php">Farmers' Guide</a></li>
            <li><a href="crop_trends.php">View Crop Trends</a></li>
            <li><a href="feedback.php">Submit Feedback</a></li>
        </ul>
    </nav>

    <main class="dashboard">
        <section>
            <h2 class="text-success text-center">Your Feedback Matters!</h2>
            <form id="feedback-form" class="mt-4" method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="<?php echo htmlspecialchars($name); ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating (1 to 5)</label>
                    <select class="form-select" id="rating" name="rating" required>
                        <option value="" disabled selected>Select a rating</option>
                        <option value="5">5 - Excellent</option>
                        <option value="4">4 - Good</option>
                        <option value="3">3 - Average</option>
                        <option value="2">2 - Poor</option>
                        <option value="1">1 - Very Poor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="comments" class="form-label">Comments</label>
                    <textarea class="form-control" id="comments" name="comments" rows="4"
                        placeholder="Write your comments here..." required></textarea>
                </div>
                <div class="mb-3">
                    <label for="suggestions" class="form-label">Suggestions</label>
                    <textarea class="form-control" id="suggestions" name="suggestions" rows="4"
                        placeholder="Your suggestions..." required></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit Feedback</button>
            </form>
        </section>

    </main>

    <footer class="text-center p-3 bg-success text-white mt-5">
        <p>&copy; 2025 Market Information System for Farmers</p>
    </footer>

</body>

</html>

<?php $conn->close(); ?>