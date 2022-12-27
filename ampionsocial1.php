<?php
  if (isset($_POST['submit'])) {
    // Connect to the database
    $conn = mysqli_connect("localhost", "username", "password", "database");
    // Check if the connection was successful
    if (!$conn) {
      die("Error: Could not connect to the database.");
    }
    // Escape the submitted message to prevent SQL injection
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    // Insert the message into the database
    $query = "INSERT INTO messages (message) VALUES ('$message')";
    mysqli_query($conn, $query);
  }
  // Retrieve the messages from the database
  $query = "SELECT message FROM messages ORDER BY id DESC";
  $result = mysqli_query($conn, $query);
  // Generate HTML elements to display the messages
  while ($row = mysqli_fetch_array($result)) {
    echo "<p>" . $row['message'] . "</p>";
  }
  // Close the database connection
  mysqli_close($conn);
?>

<!-- HTML form for submitting a message -->
<html>
 <form action="" method="post">
  <input type="text" name="message" placeholder="Enter a message">
  <button type="submit" name="submit">Send Message</button>
</form>
</html>
