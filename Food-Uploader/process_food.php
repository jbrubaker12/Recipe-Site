<?php

try {
    // Database connection parameters
    $host = '127.0.0.1'; // IP address
    $dbname = 'recipes'; // Database name
    $user = 'test'; //username
    $pass = 'test'; //password

    // Create a new PDO instance
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve form data
    $food_name = $_POST['food_name'];
    $meal_types = isset($_POST['meal_type']) ? implode(",", $_POST['meal_type']) : "";
    
    // Handle image upload
    $imageData = file_get_contents($_FILES['food_image']['tmp_name']);

    // Handle Ingredients
    $ingredients = isset($_POST["ingredients"]) ? $_POST["ingredients"] : [];

    // Access the directions (as an array)
    $directions = isset($_POST["directions"]) ? $_POST["directions"] : [];
    
    // SQL query to insert the data into the "foods" table
    $sql = "INSERT INTO foods (name, meal_type, image, ingredients, directions) VALUES (?, ?, ?, ?, ?)";

    // Prepare and execute the query, binding the parameters
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $food_name);
    $stmt->bindParam(2, $meal_types);
    $stmt->bindParam(3, $imageData, PDO::PARAM_LOB);
    $serializedIngredients = serialize($ingredients);
    $serializedDirections = serialize($directions);
    $stmt->bindParam(4, $serializedIngredients);
    $stmt->bindParam(5, $serializedDirections);
    $stmt->execute();

    // Close the database connection
    $dbh = null;

    echo "Food record added successfully.";
} catch (PDOException $e) {
    // Handle any database errors here
    echo "Database error: " . $e->getMessage();
}
?>