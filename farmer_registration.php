<?php
require 'db_config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $name = $_POST['name'];
    $age = intval($_POST['age']);
    $farmType = $_POST['farmType'];
    $location = $_POST['location'];
    $landSize = $_POST['landSize'];
    $cropsGrown = $_POST['cropsGrown'];
    $livestock = $_POST['livestock'];

  
    $sql = "INSERT INTO farmers (email, password, name, age, farm_type, location, land_size, crops_grown, livestock) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssss", $email, $password, $name, $age, $farmType, $location, $landSize, $cropsGrown, $livestock);

    if ($stmt->execute()) {
   
        echo "<script>alert('Registration successful! Thank you for registering.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
        exit;
    } else {
       
        echo "Error: " . $stmt->error;
    }

  
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Registration - MISF</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <main class="dashboard">
        <section class="registration-form">
            <h2>Register as a Farmer</h2>
            <form id="farmerRegistrationForm" action="" method="POST">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                        required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Create a password" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name"
                        required>
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" class="form-control" id="age" name="age" placeholder="Enter your age" required>
                </div>
                <div class="mb-3">
                    <label for="farmType" class="form-label">Farm Type</label>
                    <input type="text" class="form-control" id="farmType" name="farmType"
                        placeholder="Enter type of farm (e.g., Dairy, Poultry, Mixed)" required>
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" class="form-control" id="location" name="location"
                        placeholder="Enter your farm's location" required>
                </div>
                <div class="mb-3">
                    <label for="landSize" class="form-label">Land Size</label>
                    <input type="text" class="form-control" id="landSize" name="landSize"
                        placeholder="Enter land size (e.g., 5 acres)" required>
                </div>
                <div class="mb-3">
                    <label for="cropsGrown" class="form-label">Crops Grown</label>
                    <input type="text" class="form-control" id="cropsGrown" name="cropsGrown"
                        placeholder="Enter crops you grow (e.g., Rice, Wheat)" required>
                </div>
                <div class="mb-3">
                    <label for="livestock" class="form-label">Livestock</label>
                    <input type="text" class="form-control" id="livestock" name="livestock"
                        placeholder="Enter livestock you raise (e.g., Cows, Chickens)" required>
                </div>
                <button type="submit" class="btn btn-success">Register</button>
                <a href="index.php">
                    <button type="button">Home</button>
                </a>
            </form>
        </section>
    </main>

    <footer class="text-center p-3 bg-success text-white mt-5">
        <p>&copy; 2025 Market Information System for Farmers</p>
    </footer>

</body>

</html>