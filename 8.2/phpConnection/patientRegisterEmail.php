<?php
header("Access-Control-Allow-Origin: *");

// Connect to local database
$local_db = new PDO('sqlite:GpSurgery.db');

// Get email from AJAX POST request
$email = $_POST['email'];

// Check if email exists in local database
$check_email = $local_db->prepare('SELECT * FROM LocalPatient WHERE PatientEmail = :email');
$check_email->bindParam(':email', $email);
$check_email->execute();
$existing_email = $check_email->fetch(PDO::FETCH_ASSOC);

// Check if email already exists in local database
if ($existing_email) {
    echo json_encode(array('success' => true));
} else {
    echo json_encode(array('success' => false));
}