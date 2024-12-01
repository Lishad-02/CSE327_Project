<?php
  include "connection.php";
  include "navbar.php";
  include "book_request_logic.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Request</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles.css">
  <script src="script.js"></script>
</head>
<body>
  <!-- Sidenav -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="color: white; margin-left: 60px; font-size: 20px;">
      <?php
        if (isset($_SESSION['login_user'])) {
          echo "Welcome " . $_SESSION['login_user'];
        }
      ?>
    </div><br><br>
    <div class="h"> <a href="books.php">Books</a></div>
    <div class="h"> <a href="request.php">Book Request</a></div>
    <div class="h"> <a href="issue_info.php">Issue Information</a></div>
    <div class="h"><a href="expired.php">Expired List</a></div>
  </div>

  <div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
    <div class="container">
      <?php if (isset($_SESSION['login_user'])): ?>
        <div style="float: left; padding: 25px;">
          <form method="post" action="">
            <button name="submit2" type="submit" class="btn btn-default" style="background-color: #06861a; color: yellow;">RETURNED</button>
            &nbsp;&nbsp;
            <button name="submit3" type="submit" class="btn btn-default" style="background-color: red; color: yellow;">EXPIRED</button>
          </form>
        </div>
        <div class="srch">
          <br>
          <form method="post" action="">
            <input type="text" name="username" class="form-control" placeholder="Username" required><br>
            <input type="text" name="bid" class="form-control" placeholder="BID" required><br>
            <button class="btn btn-default" name="submit" type="submit">Submit</button><br><br>
          </form>
        </div>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>

