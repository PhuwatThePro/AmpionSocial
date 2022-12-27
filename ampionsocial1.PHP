## AmpionSocial
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

<!-- HTML form for uploading an image -->
<form action="" method="post" enctype="multipart/form-data">
  <label for="image">Select an image to upload:</label>
  <input type="file" name="image" id="image">
  <input type="submit" value="Upload Image" name="submit">
</form>

<html>
  <head>
    <title>Image Gallery</title>
  </head>
  <body>
    <h1>Image Gallery</h1>
    <form action="/upload" method="post" enctype="multipart/form-data">
      <input type="file" name="image" />
      <button type="submit">Upload</button>
    </form>
    <hr />
    <div id="images">
      <!-- Images will be displayed here -->
    </div>
  </body>
  <script>
    function displayImages() {
      fetch('/images')
        .then(response => response.json())
        .then(images => {
          const imageDiv = document.getElementById('images')
          imageDiv.innerHTML = ''
          for (const image of images) {
            const img = document.createElement('img')
            img.src = `/images/${image}`
            imageDiv.appendChild(img)
          }
        })
    }
    displayImages()
  </script>
</html>
