<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Register a New Library Member</title>
</head>
<body>
    <h1>Register a New Library Member</h1>
    <form action="../controller/member_controller.php" method="post">
        <label for="member_name">Name:</label>
        <input type="text" id="member_name" name="member_name" required>

        <label for="contact_info">Contact Information:</label>
        <input type="text" id="contact_info" name="contact_info" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="membership_type">Membership Type:</label>
        <select id="membership_type" name="membership_type">
            <option value="standard">Standard</option>
            <option value="premium">Premium</option>
        </select>

        <button type="submit">Register</button>
    </form>
</body>
</html>