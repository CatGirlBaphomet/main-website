<?php
$servername = "localhost";
$username = "baph";
$password = "Stift123!";
$dbname = "todo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$checked = isset($_POST['checked']) ? 1 : 0;

$sql = "INSERT INTO checklist (title, checked) VALUES ('$title', '$checked')";

if ($conn->query($sql) === TRUE) {
  $itemId = $conn->insert_id;
  $subitems = [];
  for ($i = 1; $i <= 10; $i++) {
    if (!empty($_POST['subitem' . $i])) {
        $subitems[] = $_POST['subitem' . $i];
        $subitem = $_POST['subitem' . $i];
        $subitemChecked = isset($_POST['subitem_checked' . $i]) ? 1 : 0;
        $sql = "INSERT INTO subitems (item_id, title, checked) VALUES ('$itemId', '$subitem', '$subitemChecked')";
        if ($conn->query($sql) !== TRUE) {
            $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
            break;
        }
    }
  }
  $_SESSION['message'] = "New record created successfully";
} else {
  $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: index.php'); // redirect to the home page
exit();
?>