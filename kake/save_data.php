<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = urldecode($_POST["data"]);

    // Parse the posted XML data
    $postedXml = simplexml_load_string($data);
    if ($postedXml === false) {
        die('Failed to parse posted XML data');
    }

    // Database credentials
    $host = 'localhost';
    $db   = 'your_database';
    $user = 'your_username';
    $pass = 'your_password';
    $charset = 'utf8mb4';

    // DSN (Data Source Name)
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

    // Create a PDO instance
    $pdo = new PDO($dsn, $user, $pass);

    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("INSERT INTO items (title, subitems) VALUES (?, ?)");
    $stmt->execute([$postedXml->title, json_encode($postedXml->subitems->subitem)]);

    echo "Data saved successfully!";
} else {
    echo "Invalid request.";
}
?>