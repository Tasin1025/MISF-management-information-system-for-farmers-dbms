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

$farmer_email = $user['email']; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $activity_date = $_POST['activity_date'];
    $activity_description = $_POST['activity_description'];
    $status = $_POST['status'];
    $remarks = $_POST['remarks'];

    $insert_sql = "INSERT INTO farmer_activities (farmer_email, activity_date, activity_description, status, remarks) 
                   VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("sssss", $farmer_email, $activity_date, $activity_description, $status, $remarks);
    $stmt->execute();
    $stmt->close();

    header("Location: farmer_dashboard.php");
    exit();
}


$activities_sql = "SELECT * FROM farmer_activities WHERE farmer_email = ?";
$stmt = $conn->prepare($activities_sql);
$stmt->bind_param("s", $farmer_email);
$stmt->execute();
$activities_result = $stmt->get_result();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmers Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header class="header">
        <div class="header-left">
            <h1>🌾 Farmers Dashboard 🌾</h1>
        </div>
        <div class="header-right">
            <span>Welcome, <?php echo $user['name']; ?></span>
            <a href="logout.php">
                <button type="button">Logout</button>
            </a>
        </div>
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
        <section id="welcome">
            <h2>👋 Welcome, Farmer!</h2>
            <p>Your one-stop solution for real-time market data, personalized recommendations, weather updates, and
                more.</p>
        </section>

        <section class="farmer-overview">
            <h2>Farmer's Overview</h2>
            <div class="farmer-card">
                <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
                <p><strong>Age:</strong> <?php echo $user['age']; ?></p>
                <p><strong>Farm Type:</strong> <?php echo $user['farm_type']; ?></p>
                <p><strong>Location:</strong> <?php echo $user['location']; ?></p>
                <p><strong>Land Size:</strong> <?php echo $user['land_size']; ?></p>
                <p><strong>Crops Grown:</strong> <?php echo $user['crops_grown']; ?></p>
                <p><strong>Livestock:</strong> <?php echo $user['livestock']; ?></p>

            </div>
        </section>


        <section class="farmer-activities">
            <h2>Recent Activities</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Activity</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($activity = $activities_result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($activity['activity_date']); ?></td>
                        <td><?php echo htmlspecialchars($activity['activity_description']); ?></td>
                        <td><?php echo htmlspecialchars($activity['status']); ?></td>
                        <td><?php echo htmlspecialchars($activity['remarks']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>


        <section class="registration-form">
            <h2>Add a New Activity</h2>
            <form id="addActivityForm" method="POST" action="">

                <div class="mb-3">
                    <label for="activityDate" class="form-label">Activity Date</label>
                    <input type="date" class="form-control" id="activityDate" name="activity_date" required>
                </div>

                <div class="mb-3">
                    <label for="activityDescription" class="form-label">Activity Description</label>
                    <input type="text" class="form-control" id="activityDescription" name="activity_description"
                        placeholder="e.g., Harvested Wheat" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Completed">Completed</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Planned">Planned</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="remarks" class="form-label">Remarks</label>
                    <textarea class="form-control" id="remarks" name="remarks" rows="3"
                        placeholder="Any additional details..."></textarea>
                </div>

                <button type="submit" class="btn btn-success">Save Activity</button>

            </form>
        </section>



        <section class="statistics">
            <h2>Farming Statistics</h2>
            <canvas id="activityChart" width="400" height="200"></canvas>
            <div class="stats-info">
                <p><strong>Total Crops Harvested in 2024:</strong> 120 Tons</p>
                <p><strong>Livestock Production:</strong> 500 Liters of Milk Daily</p>
                <p><strong>Monthly Revenue:</strong> 8,000 taka</p>
                <p><strong>Farm Expenses:</strong> 3,500 taka</p>
                <p><strong>Profit Margin:</strong> 4,500 taka</p>
            </div>
        </section>
        <footer>
        <p>© 2025 Market Information System for Farmers</p>
    </footer>
    </main>

    <script>
    const ctx = document.getElementById('activityChart').getContext('2d');
    const activityChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Harvested Crops', 'Livestock Revenue', 'Expenses', 'Profit'],
            datasets: [{
                label: 'Farming Statistics',
                data: [120, 8000, 3500, 4500],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>

</html>