<?php
  include "connection.php";  // Database connection
  include "navbar.php";      // Navbar inclusion

  if(isset($_SESSION['login_user'])) {
      // If the user is logged in, display the forms
      if(isset($_POST['submit'])) {
          $var1 = '<p style="color:yellow; background-color:green;">RETURNED</p>';
          // Update book status to "RETURNED"
          mysqli_query($db, "UPDATE issue_book SET approve='$var1' WHERE username='$_POST[username]' AND bid='$_POST[bid]' ");
          // Increase the book quantity after return
          mysqli_query($db, "UPDATE books SET quantity = quantity+1 WHERE bid='$_POST[bid]' ");
      }
  }

  // Logic for button handling
  $ret = '<p style="color:yellow; background-color:green;">RETURNED</p>';
  $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
  
  if(isset($_POST['submit2'])) {
      // Query to fetch "RETURNED" books
      $sql = "SELECT student.username, roll, books.bid, name, authors, edition, approve, issue, issue_book.return FROM student 
              INNER JOIN issue_book ON student.username=issue_book.username 
              INNER JOIN books ON issue_book.bid=books.bid 
              WHERE issue_book.approve ='$ret' ORDER BY issue_book.return DESC";
      $res = mysqli_query($db, $sql);
  } else if(isset($_POST['submit3'])) {
      // Query to fetch "EXPIRED" books
      $sql = "SELECT student.username, roll, books.bid, name, authors, edition, approve, issue, issue_book.return FROM student 
              INNER JOIN issue_book ON student.username=issue_book.username 
              INNER JOIN books ON issue_book.bid=books.bid 
              WHERE issue_book.approve ='$exp' ORDER BY issue_book.return DESC";
      $res = mysqli_query($db, $sql);
  } else {
      // Query to fetch books that are neither returned nor approved
      $sql = "SELECT student.username, roll, books.bid, name, authors, edition, approve, issue, issue_book.return FROM student 
              INNER JOIN issue_book ON student.username=issue_book.username 
              INNER JOIN books ON issue_book.bid=books.bid 
              WHERE issue_book.approve !='' AND issue_book.approve !='Yes' ORDER BY issue_book.return DESC";
      $res = mysqli_query($db, $sql);
  }

  // Display records in a table format
  echo "<table class='table table-bordered' style='width:100%;'>";
  echo "<tr style='background-color: #6db6b9e6;'>
          <th>Username</th>
          <th>Roll No</th>
          <th>BID</th>
          <th>Book Name</th>
          <th>Authors Name</th>
          <th>Edition</th>
          <th>Status</th>
          <th>Issue Date</th>
          <th>Return Date</th>
        </tr>";

  echo "<div class='scroll'>";
  echo "<table class='table table-bordered'>";
  while($row = mysqli_fetch_assoc($res)) {
      echo "<tr>";
          echo "<td>".$row['username']."</td>";
          echo "<td>".$row['roll']."</td>";
          echo "<td>".$row['bid']."</td>";
          echo "<td>".$row['name']."</td>";
          echo "<td>".$row['authors']."</td>";
          echo "<td>".$row['edition']."</td>";
          echo "<td>".$row['approve']."</td>";
          echo "<td>".$row['issue']."</td>";
          echo "<td>".$row['return']."</td>";
      echo "</tr>";
  }
  echo "</table>";
  echo "</div>";
?>

