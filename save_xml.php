<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = urldecode($_POST["data"]);
    file_put_contents("data.xml", $data);
    echo "Data saved successfully!";
} else {
    echo "Invalid request.";
}
?>