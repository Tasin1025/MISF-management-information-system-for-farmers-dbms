<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Trends</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <!-- Header Section -->
    <header>
        <h1>📊 Crop Trends 📊</h1>
    </header>

    <nav class="menu-card">
        <ul>
            <li><a href="farmer_dashboard.php">Home</a></li>
            <li><a href="farmers_guide.php">Farmers' Guide</a></li>
            <li><a href="crop_trends.php">View Crop Trends</a></li>
            <li><a href="feedback.php">Submit Feedback</a></li>
        </ul>
    </nav>
    <!-- Main Content -->
    <main>
        <section id="trend-analysis">
            <h2>Crop Prices by Season</h2>
            <table>
                <thead>
                    <tr>
                        <th>Crop</th>
                        <th>Summer</th>
                        <th>Rainy</th>
                        <th>Winter</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Coarse Rice</td>
                        <td>54৳</td>
                        <td>53৳</td>
                        <td>52৳</td>
                    </tr>
                    <tr>
                        <td>Fine Rice</td>
                        <td>68৳</td>
                        <td>67৳</td>
                        <td>66৳</td>
                    </tr>
                    <tr>
                        <td>Wheat Flour (Atta)</td>
                        <td>65৳</td>
                        <td>64৳</td>
                        <td>63৳</td>
                    </tr>
                    <tr>
                        <td>Lentils (Masoor Dal)</td>
                        <td>130৳</td>
                        <td>129৳</td>
                        <td>127৳</td>
                    </tr>
                    <tr>
                        <td>Green Grams (Moong Dal)</td>
                        <td>121৳</td>
                        <td>120৳</td>
                        <td>118৳</td>
                    </tr>
                    <tr>
                        <td>Soybean Oil</td>
                        <td>180৳</td>
                        <td>179৳</td>
                        <td>177৳</td>
                    </tr>
                    <tr>
                        <td>Mustard Oil</td>
                        <td>230৳</td>
                        <td>229৳</td>
                        <td>227৳</td>
                    </tr>
                    <tr>
                        <td>Potatoes</td>
                        <td>75৳</td>
                        <td>74৳</td>
                        <td>72৳</td>
                    </tr>
                    <tr>
                        <td>Onions</td>
                        <td>108৳</td>
                        <td>104৳</td>
                        <td>102৳</td>
                    </tr>
                    <tr>
                        <td>Garlic</td>
                        <td>218৳</td>
                        <td>214৳</td>
                        <td>212৳</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="trend-graphs">
            <h2>Price Trends Graph</h2>
            <canvas id="cropChart" width="400" height="200"></canvas>
        </section>


    </main>

    <footer>
        <p>© 2025 Market Information System for Farmers</p>
    </footer>

    <script>
    const ctx = document.getElementById('cropChart').getContext('2d');
    const cropChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Summer', 'Rainy', 'Winter'],
            datasets: [{
                    label: 'Coarse Rice',
                    data: [54, 53, 52],
                    borderColor: 'blue',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Fine Rice',
                    data: [68, 67, 66],
                    borderColor: 'green',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Wheat Flour (Atta)',
                    data: [65, 64, 63],
                    borderColor: 'orange',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Lentils (Masoor Dal)',
                    data: [130, 129, 127],
                    borderColor: 'red',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Green Grams (Moong Dal)',
                    data: [121, 120, 118],
                    borderColor: 'sky blue',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Soybean Oil',
                    data: [180, 179, 177],
                    borderColor: 'brown',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Mustard Oil',
                    data: [230, 229, 227],
                    borderColor: 'wine red',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Potatoes',
                    data: [75, 74, 72],
                    borderColor: 'gray',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Onions',
                    data: [108, 104, 102],
                    borderColor: 'violet',
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Garlic',
                    data: [218, 214, 212],
                    borderColor: 'crimson red',
                    borderWidth: 2,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Seasons'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Price (in ৳)'
                    }
                }
            }
        }
    });
    </script>
</body>

</html>