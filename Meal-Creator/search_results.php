<?php
// Database connection parameters
$host = '127.0.0.1'; // IP address
$dbname = 'recipes'; // Database name
$user = 'test'; // Replace with your database username
$pass = 'test'; // Replace with your database password

try {
    // Create a new PDO instance
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

    // Set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle any database connection errors here
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Get user search input
$userSearch = isset($_POST["search"]) ? $_POST["search"] : '';

// Create SQL query statement using a prepared statement with a named placeholder
$sql = "SELECT * FROM foods WHERE name LIKE :userSearch";

try {
    // Prepare and execute the SQL statement
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':userSearch', '%' . $userSearch . '%', PDO::PARAM_STR);
    $stmt->execute();

    // Fetch and display the results
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        echo "<h1>Search Results:</h1>";
        foreach ($result as $row) {
            echo "Name: " . $row['name'] . "<br>";
            $imageData = $row['image'];
            $base64Image = base64_encode($imageData);
            $imageTag = '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Image">';
            echo $imageTag;
            echo "<br>";
            $ingredients = unserialize($row['ingredients']);
            echo "Ingredients: <br>";
            foreach ($ingredients as $ingredient) {
                echo "- " . $ingredient . "<br>";
            }
            // Unserialize and display directions
            $directions = unserialize($row['directions']);
            echo "Directions: <br>";
            foreach ($directions as $direction) {
                echo "- " . $direction . "<br>";
            }
        }
    } else {
        echo "No results found.";
    }
} catch (PDOException $e) {
    // Handle any database query errors here
    echo "Query failed: " . $e->getMessage();
}

// Close the DB connection
$dbh = null;
?>
