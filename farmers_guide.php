<?php
session_start();
require 'db_config.php'; 


$sql_crops = "SELECT id, name, price FROM crops";
$result_crops = $conn->query($sql_crops);

$sql_seeds = "SELECT seeds.id, seeds.name, seeds.price FROM seeds";
$result_seeds = $conn->query($sql_seeds);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=deviACce-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h1>👨‍🌾 Farmers' Guide 👨‍🌾</h1>
    </header>

    <nav class="menu-card">
        <ul>
            <li><a href="farmer_dashboard.php">Home</a></li>
            <li><a href="farmers_guide.php">Farmers' Guide</a></li>
            <li><a href="crop_trends.php">View Crop Trends</a></li>
            <li><a href="feedback.php">Submit Feedback</a></li>
        </ul>
    </nav>

    <main>
        <section id="market-prices">
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

            <h2>Current Seed Prices</h2>
            <table>
                <thead>
                    <tr>
                        <th>Seed Type</th>
                        <th>Price (per kg)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_seeds && $result_seeds->num_rows > 0) {
                        while ($row = $result_seeds->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['price']) . " ৳</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2' class='text-center'>No seed data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section id="recommendations">
            <h2>Recommendations</h2>
            <ul>
                <li>🌾 Plant Wheat in November for a higher yield.</li><br>
                <li>🍚 Sell Rice in South Market this week for a better price.</li><br>
                <li>🥔 Avoid planting Potatoes this month due to heavy rainfall.</li><br>
                <li>🌾 Perfect time for Aman Rice harvesting to avoid moisture affecting quality.</li><br>
                <li>🍠 Delay Sweet Potato planting as heavy rain can cause root rot.</li><br>
                <li>🌾 Start field preparation for Boro Rice with proper irrigation for dry fields.</li><br>
                <li>🍅 November's cooler weather is ideal for planting Tomatoes.</li><br>
                <li>💰 With rising costs, consider using organic alternatives to cut expenses.</li><br>
                <li>🥗 Plant cool-season crops like peas, lettuce, and radishes for a fresh start to the season.</li>
                <br>
                <li>🌶️ Focus on heat-loving crops such as tomatoes, peppers, and cucumbers for a productive harvest.
                </li><br>
                <li>🥕 Sow root vegetables like carrots, turnips, and sweet potatoes for a hearty autumn harvest.</li>
                <br>
                <li>🌽 Consider planting beans and corn for an early-summer bounty.</li><br>
                <li>🎃 For late-season harvests, plant squash, pumpkins, and melons.</li><br>
                <li>🧄 Try planting garlic and onions for a winter crop that will be ready early next year.</li><br>
                <li>🌿 Start herb gardens with basil, cilantro, and dill to add fresh flavor to your dishes.</li><br>
                <li>🥒 Opt for fast-growing crops like zucchini and green beans that thrive in the summer heat.</li><br>
            </ul>
        </section>
    </main>

    <footer>
        <p>© 2025 Market Information System for Farmers</p>
    </footer>
</body>

</html>