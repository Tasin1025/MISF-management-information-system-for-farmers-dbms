<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Page - MISF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <h1>🛒 Buyer Dashboard 🛒</h1>
    </header>

    <nav class="menu-card">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="farmers_guide.html">Farmers' Guide</a></li>
            <li><a href="crop_trends.html">View Crop Trends</a></li>
            <li><a href="feedback.html">Submit Feedback</a></li>
            <li><a href="seller.html">Seller Registration</a></li>
            <li><a href="buyer.html">Buyer Registration</a></li>
            <li><a href="login.html">Login</a></li>
            <li><a href="register.html">Register</a></li>
        </ul>
    </nav>

    <main>
        <!-- Crop Listings Section -->
        <section class="crop-listings">
            <h2>Available Crops</h2>
            <div class="search-bar">
                <input type="text" id="search-input" placeholder="Search crops by name...">
                <select id="filter-category">
                    <option value="all">All</option>
                    <option value="seeds">Seeds</option>
                    <option value="fertilizers">Fertilizers</option>
                    <option value="equipment">Equipment</option>
                </select>
                <button id="search-button">Search</button>
            </div>
            <!-- Dynamic crop listings will appear here -->
        </section>

        <!-- Inquiry Section -->
        <section class="send-inquiry">
            <h2>Send Inquiry</h2>
            <form id="inquiry-form">
                <label for="crop-name-inquiry">Crop Name:</label>
                <input type="text" id="crop-name-inquiry" placeholder="Enter crop name" required>

                <label for="seller-contact">Seller Contact:</label>
                <input type="text" id="seller-contact" placeholder="Enter seller contact" required>

                <label for="message">Message:</label>
                <textarea id="message" placeholder="Write your inquiry here" required></textarea>

                <button type="submit">Send Inquiry</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Market Information System for Farmers</p>
    </footer>
</body>
</html>
