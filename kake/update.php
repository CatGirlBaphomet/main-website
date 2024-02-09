<?php
$servername = "localhost";
$username = "baph";
$password = "Stift123!";
$dbname = "todo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // This is an AJAX request to update the state of a checkbox
  $id = $_POST['id'];
  $checked = $_POST['checked'] ? 1 : 0;
  $isSubitem = isset($_POST['isSubitem']) && $_POST['isSubitem'];

  $table = $isSubitem ? 'subitems' : 'checklist';

  $sql = "UPDATE $table SET checked = $checked WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully. Affected rows: " . $conn->affected_rows;
  } else {
    echo "Error updating record: " . $conn->error;
  }
} else {
  // This is a GET request to display the checklist
  $sql = "SELECT id, title, checked FROM checklist";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    echo '<div class="container">';
    while($row = $result->fetch_assoc()) {
      $title = $row['title'];
      $checked = $row['checked'] ? 'checked' : '';
      echo '<div class="item-container">';
      echo '<div class="item">';
      echo '<input type="checkbox" class="item-checkbox" data-id="' . $row['id'] . '" ' . $checked . '>';
      echo '<span class="item-title">' . $title . '</span>';

      $itemId = $row['id'];
      $subitemsSql = "SELECT id, title, checked FROM subitems WHERE item_id = $itemId";
      $subitemsResult = $conn->query($subitemsSql);
      if ($subitemsResult->num_rows > 0) {
        echo '<div class="subitems">';
        while($subitemRow = $subitemsResult->fetch_assoc()) {
          $subitemTitle = $subitemRow['title'];
          $subitemChecked = $subitemRow['checked'] ? 'checked' : '';
          echo '<input type="checkbox" class="subitem-checkbox" data-id="' . $subitemRow['id'] . '" ' . $subitemChecked . '>';
          echo '<span class="subitem-title">' . $subitemTitle . '</span>';
          echo '<br>';
        }
        echo '</div>';
      }

      echo '</div>';
      echo '</div>';
    }
    echo '</div>';
  } else {
    echo "No items found";
  }
}

$conn->close();
?>