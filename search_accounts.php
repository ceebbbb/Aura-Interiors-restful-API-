<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['search'])) {
    echo json_encode(array('message' => 'Search term is required', 'status' => false));
    exit;
}

$search_val = $data['search'];

include "databaseConnect.php";

$sql = "SELECT * FROM accounts WHERE username LIKE '%{$search_val}%' OR email LIKE '%{$search_val}%' OR firstName LIKE '%{$search_val}%' OR lastName LIKE '%{$search_val}%'";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(array('message' => 'SQL query failed', 'status' => false));
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'No matching accounts found', 'status' => false));
}

?>