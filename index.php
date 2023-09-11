<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Web Page</title>
    <meta name="description" content="A simple web page">
    <link rel="stylesheet" href="styles.css">
    <!-- You can link to your CSS file here -->
</head>
<body>
    <header>
        <h1>Recipe Selector Site for Jayce and Kaycee &lt;3 </h1>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./Random-Food/random-food.php">Random Food</a></li>
                <li><a href="./Food-Picker/food-picker.php">Food Picker</a></li>
                <li><a href="./Food-Uploader/food_form.html">Food Uploader</a></li>
            </ul>
        </nav>
    </header>

    <main>
        
    </main>

    <footer>
        <p>&copy; 2023 My Web Page</p>
</footer>
</body>
</html>

<?php
try {
    // Database connection parameters
    $host = '127.0.0.1'; // IP address
    $dbname = 'recipes'; // Database name
    $user = 'if0_35000919'; // Replace with your database username
    $pass = 'DfYM1aIbGE2MGX'; // Replace with your database password

    // Create a new PDO instance
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to select all records from the "foods" table
    $sql = "SELECT * FROM foods";

    // Prepare and execute the query
    $stmt = $dbh->query($sql);

    // Fetch all rows as an associative array
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Print the results or process them as needed
    foreach ($result as $row) {
        print_r($row);
    }

    // Close the database connection
    $dbh = null;
} catch (PDOException $e) {
    // Handle any database errors here
    echo "Connection failed: " . $e->getMessage();
}
?>