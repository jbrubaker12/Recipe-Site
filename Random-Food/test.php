<?php
// Database connection parameters
$hostname = 'localhost';  // Change to your database hostname
$username = 'test';  // Change to your database username
$password = 'test';  // Change to your database password
$database = 'recipes';  // Change to your database name

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Image ID to retrieve (you can change this)
    $imageId = 2;

    // Query to retrieve image data by ID
    $query = "SELECT image FROM foods WHERE id = :imageId";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':imageId', $imageId, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the image data
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Set appropriate content type for the image (e.g., JPEG)

        // Output the image data
        $imageData = $result['image'];
        $base64Image = base64_encode($imageData);
        $imageTag = '<img src="data:image/jpeg;base64,' . $base64Image . '" alt="Image">';
        echo $imageTag;
    } else {
        echo "Image not found";
    }
} catch (PDOException $e) {
    echo "Database Connection Error: " . $e->getMessage();
}
?>