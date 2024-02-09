<?php
$servername = "localhost";
$username = "baph";
$password = "Stift123!";
$dbname = "todo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$title = $_POST['title'];
$completed = isset($_POST['completed']) ? 1 : 0; // New line
$subitems = $_POST['subitems'];
$toDelete = $_POST['toDelete'];

$sql = "UPDATE checklist SET title = ?, completed = ? WHERE id = ?"; // Updated line
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $title, $completed, $id); // Updated line
$stmt->execute();

foreach ($toDelete as $subitem_id) {
  $sql = "DELETE FROM subitems WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $subitem_id);
  $stmt->execute();
}

foreach ($subitems as $subitem_title) {
  $sql = "INSERT INTO subitems (title, item_id) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $subitem_title, $id);
  $stmt->execute();
}

$conn->close();

header("Location: index.php");
?>