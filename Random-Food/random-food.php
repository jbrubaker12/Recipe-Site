<?php

try {
    // Database connection parameters
    $host = '127.0.0.1'; // IP address
    $dbname = 'recipes'; // Database name
    $user = 'test'; // Replace with your database username
    $pass = 'test'; // Replace with your database password

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

    // function to get the image ready to display
    function displayImage($randomFood) {
        $imageData = $randomFood['image'];
        $base64Image = base64_encode($imageData);
        $imageTag = '<img id="foodImage" src="data:image/jpeg;base64,' . $base64Image . '" alt="Image">';
        echo $imageTag;
    }
   
    // Close the database connection
    $dbh = null;

    // Close the database connection
    $dbh = null;
} catch (PDOException $e) {
    // Handle any database errors here
    echo "Connection failed: " . $e->getMessage();
}

?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Web Page</title>
        <meta name="description" content="A simple web page">
        <link rel="stylesheet" type="text/css" href="random-food.css">
    </head>
    <header>
        <h1>Recipe Selector Site for Jayce and Kaycee &lt;3 </h1>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../Random-Food/random-food.php">Random Food</a></li>
                    <li><a href="../Food-Picker/food-picker.php">Food Picker</a></li>
                    <li><a href="../Food-Uploader/food_form.html">Food Uploader</a></li>
                </ul>
            </nav>
    </header>
    <body>
        <p>random-food</p>
        <p> id: <?php echo $randomFood['id']; ?></p>
        <p>Food Name: <?php echo $randomFood['name']; ?></p>
        <?php echo displayImage($randomFood) ?>
        <p>Food Type: <?php echo $randomFood['meal_type']; ?></p>
    </body>
</html>

<?php
// Unserialize and display ingredients
$ingredients = unserialize($randomFood['ingredients']);
echo "Ingredients: <br>";
foreach ($ingredients as $ingredient) {
    echo "- " . $ingredient . "<br>";
}

// Unserialize and display directions
$directions = unserialize($randomFood['directions']);
echo "Directions: <br>";
foreach ($directions as $direction) {
    echo "- " . $direction . "<br>";
}
?>