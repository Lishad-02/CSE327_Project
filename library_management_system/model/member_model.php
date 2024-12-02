<?php
/* This is a multi-line comment in PHP
   Contains functions related to member activities */

require_once 'database.php';

function add_new_member($member_name, $contact_info, $address, $email, $membership_type) {
    global $pdo;

    $sql = "INSERT INTO members (member_name, contact_info, address, email, membership_type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$member_name, $contact_info, $address, $email, $membership_type]);

    return $pdo->lastInsertId(); /* returns the last inserted membership_id */
}
?>