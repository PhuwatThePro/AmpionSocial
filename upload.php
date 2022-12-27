<?php
  if (isset($_POST['submit'])) {
    // Check if a file has been uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
      // Display an error message if the file was not uploaded
      echo "Error: The file was not uploaded.";
      exit;
    }
    // Move the uploaded file to a permanent location
    $upload_dir = "uploaded_images/";
    $upload_file = $upload_dir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_file)) {
      // Generate an HTML img element that displays the uploaded image
      echo "<img src='$upload_file'>";
    } else {
      // Display an error message if the file could not be moved
      echo "Error: The file could not be moved.";
      exit;
    }
  }
?>
