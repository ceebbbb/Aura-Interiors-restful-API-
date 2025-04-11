<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

include "databaseConnect.php";

$data = json_decode(file_get_contents("php://input"), true);

if(empty($data['search'])) {
    echo json_encode(array('message' => 'Search term is required', 'status' => false));
    exit;
}

$search = mysqli_real_escape_string($conn, $data['search']);

// Search for matching email or contact number //
$sql = "SELECT * FROM EnquiryForm WHERE email LIKE '%{$search}%' OR contactNo LIKE '%{$search}%'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(array('message' => 'SQL query failed', 'status' => false));
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'No matching enquiry records found', 'status' => false));
}

?>