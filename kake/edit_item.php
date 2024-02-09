<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      background-color: #1a1a1a;
      color: #ffffff;
      font-family: Arial, sans-serif;
      margin: 0 auto;
      width: 10%;
    }
    a, input[type="text"], textarea {
      display: block;
      color: #a636ff;
      margin-bottom: 10px;
    }
    a:hover, button:hover {
      text-decoration: underline;
    }
    button {
      color: #a636ff;
      background-color: #1a1a1a;
      border: none;
      cursor: pointer;
    }
    .subitem {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    button {
        text-decoration: none;
        border: 1px solid #a636ff;
        margin-bottom: 6px;
        margin-top: -5px;
    }
    button:hover {
        background-color: #454545;
        text-decoration: none;
        
    }
    .full-width-button {
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 10px;
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

  $id = $_GET['id'];
  $sql = "SELECT * FROM checklist WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<form action='save_edit.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
    echo "<input type='text' name='title' value='" . $row["title"] . "'>";

     // Fetch and display subitems
  $sql = "SELECT * FROM subitems WHERE item_id = $id";
  $subitems = $conn->query($sql);
  if ($subitems->num_rows > 0) {
      while($subitem = $subitems->fetch_assoc()) {
          echo "<div class='subitem'>";
          echo "<input type='text' name='subitems[]' value='" . $subitem["title"] . "'>";
          echo "<button type='button' onclick='deleteSubitem(this, " . $subitem["id"] . ")'>-</button>";
          echo "</div>";
        }
      }
      
      echo "<div id='addSubitem'></div>";
      echo "<button class='full-width-button' type='button' onclick='addSubitem()'>+</button><br>";
      echo "<button class='full-width-button' type='submit'>Save</button>";
      echo "</form>";
      echo "<button class='full-width-button' onclick=\"location.href='delete_item.php?id=" . $row["id"] . "'\">Delete</button>";
      } else {
      echo "No such todo item";
      }

$conn->close();
?>
<script>
  function addSubitem() {
    var div = document.createElement('div');
    div.className = 'subitem';
    var input = document.createElement('input');
    input.type = 'text';
    input.name = 'subitems[]';
    div.appendChild(input);
    var button = document.createElement('button');
    button.textContent = '-';
    button.type = 'button';
    button.onclick = function() {
      div.remove();
    };
    div.appendChild(button);
    document.getElementById('addSubitem').appendChild(div);
  }

  function deleteSubitem(button, id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "delete_subitem.php?id=" + id, true);
    xhr.onload = function () {
      if (xhr.readyState == 4 && xhr.status == "200") {
        // If the deletion was successful, remove the subitem from the DOM
        button.parentNode.remove();
      } else {
        console.error(xhr.responseText);
      }
    }
    xhr.send(null);
  }
</script>
</body>
</html>