<?php
  if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $bid = mysqli_real_escape_string($db, $_POST['bid']);
    $approve = '<p style="color:yellow; background-color:green;">RETURNED</p>';

    $stmt = $db->prepare("UPDATE issue_book SET approve=? WHERE username=? AND bid=?");
    $stmt->bind_param("sss", $approve, $username, $bid);
    if ($stmt->execute()) {
      mysqli_query($db, "UPDATE books SET quantity = quantity + 1 WHERE bid='$bid'");
      echo "<p>Record updated successfully!</p>";
    } else {
      echo "<p>Error updating record: " . $stmt->error . "</p>";
    }
    $stmt->close();
  }

  $status = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
  if (isset($_POST['submit2'])) {
    $query = "SELECT * FROM issue_book WHERE approve='$status'";
  } else {
    $query = "SELECT * FROM issue_book";
  }
  $result = mysqli_query($db, $query);

  if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'><thead>";
    echo "</table>";
  }
?>
