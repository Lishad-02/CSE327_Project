<?php

/** 
 * Search Book Input Page
 * 
 * This page allows the user to input a search term and see the search results for books.
 */

if (isset($_GET['error'])) {
    echo '<p>' . htmlspecialchars($_GET['error']) . '</p>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Book</title>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>
<body>

<div class="container">
    <h2>Search for Books</h2>
    
    <form method="GET" action="index.php">
        <label for="search_term">Search Term:</label>
        <input type="text" id="search_term" name="search_term" required>
        <button type="submit">Search</button>
    </form>
</div>

</body>
</html>
