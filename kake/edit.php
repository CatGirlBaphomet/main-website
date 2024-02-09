<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      background-color: #1a1a1a;
      color: #ffffff;
      font-family: Arial, sans-serif;
    }
    a {
      display: block;
      color: #a636ff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <?php
  $servername = "localhost";
  $username = "baph";
  $password = "Stift123!";
  $dbname = "todo";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT id, title FROM checklist";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<a href='edit_item.php?id=" . $row["id"] . "'>" . $row["title"] . "</a>";
    }
  } else {
    echo "No todo items";
  }

  $conn->close();
  ?>
</body>
</html>