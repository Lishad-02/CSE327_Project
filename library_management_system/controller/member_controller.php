<?php
/* This is a multi-line comment in PHP
   Handles member registration logic */

require_once '../model/member_model.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $member_name = $_POST['member_name'];
    $contact_info = $_POST['contact_info'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $membership_type = $_POST['membership_type'];

    $membership_id = add_new_member($member_name, $contact_info, $address, $email, $membership_type);
    header("Location: ../view/confirmation.php?id=" . $membership_id);
    exit();
}
?>