<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta property="og:title" content="KΛKE">
  <meta property="og:description" content="KΛKE Development progress / todo list">
  <meta property="og:image" content="https://baph.dev/kake/img/kake.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="img/kake.png" type="image/gif" sizes="16x16">
  <title>Checklist</title>
  <link rel="stylesheet" href="css/kake.css">
  <style>
    .item-title:hover {
      text-decoration: underline;
    }

    .subitem {
      display: flex;
      align-items: center;
    }

    .subitem input[type="checkbox"] {
      margin-right: 10px;
    }
  </style>
</head>

<body>
  <div class="dropdown">
    <div class="dropbtn">Edit</div>
    <div id="myDropdown" class="dropdown-content">
      <a href="add.html">Add</a>
      <a href="edit.php">Edit</a>
    </div>
  </div>
  <!-- <div class="container"> -->
    <div id="checklist-container">
      <?php include 'update.php'; ?>
    </div>
    <div id="finished-items-container">
      <!-- Your finished items will go here -->
    </div>
  </div>
  <?php
  session_start();

  if (isset($_SESSION['message'])) {
    echo '<div id="message">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']); // remove the message
  }
  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('.dropbtn').click(function() {
      $('#myDropdown').toggleClass('show');
    });

    $('.item-title').click(function() {
      $(this).next('.subitems').slideToggle();
    });

    $('.item-checkbox, .subitem-checkbox').change(function() {
  var id = $(this).data('id');
  var checked = $(this).prop('checked') ? '1' : '0';
  var isSubitem = $(this).hasClass('subitem-checkbox') ? '1' : '0';
  $.ajax({
    url: 'save_state.php',
    method: 'POST',
    data: {
      id: id,
      checked: checked,
      isSubitem: isSubitem
    },
    success: function(response) {
      console.log(response);
    }
  });
});
  });
</script>
</script>
</body>
</html>