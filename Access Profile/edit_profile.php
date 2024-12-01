<?php
    include "navbar.php";
    include "connection.php";
    
    session_start();
    
    // Fetch user data from database
    $sql = "SELECT * FROM student WHERE username = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, 's', $_SESSION['login_user']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        $first = $row['first'];
        $last = $row['last'];
        $username = $row['username'];
        $password = $row['password'];
        $email = $row['email'];
        $contact = $row['contact'];
    }

    // Handle form submission
    if (isset($_POST['submit'])) {
        $first = $_POST['first'];
        $last = $_POST['last'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];

        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Update the user's information
        $sql1 = "UPDATE student SET first = ?, last = ?, username = ?, password = ?, email = ?, contact = ? WHERE username = ?";
        $stmt1 = mysqli_prepare($db, $sql1);
        mysqli_stmt_bind_param($stmt1, 'sssssss', $first, $last, $username, $passwordHash, $email, $contact, $_SESSION['login_user']);
        if (mysqli_stmt_execute($stmt1)) {
            echo "<script type='text/javascript'>
                    alert('Saved Successfully.');
                    window.location='profile.php';
                  </script>";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    }
?>
