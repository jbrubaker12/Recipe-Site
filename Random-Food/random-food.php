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

    // SQL query to select a random record from the "foods" table
    $sql = "SELECT * FROM foods ORDER BY RAND() LIMIT 1";

    // Prepare and execute the query
    $stmt = $dbh->query($sql);

    // Fetch the random record as an associative array
    $randomFood = $stmt->fetch(PDO::FETCH_ASSOC);

    // Close the database connection
    $dbh = null;

    // Close the database connection
    $dbh = null;
} catch (PDOException $e) {
    // Handle any database errors here
    echo "Connection failed: " . $e->getMessage();
}

?>

<html>
    <p>random-food</p>
    <p> id: <?php echo $randomFood['id']; ?></p>
    <p>Food Name: <?php echo $randomFood['name']; ?></p>
    <img src="<?php echo $randomFood['image']; ?> alt=Food Image">
    <p>Food Type: <?php echo $randomFood['meal_type']; ?></p>
</html>