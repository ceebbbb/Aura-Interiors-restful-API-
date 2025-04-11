<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['account_id'])) {
    echo json_encode(array('message' => 'Account ID is required', 'status' => false));
    exit;
}

$account_id = $data['account_id'];

include "databaseConnect.php";

$sql = "SELECT * FROM accounts WHERE account_id = {$account_id}";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(array('message' => 'SQL query failed', 'status' => false));
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'Account not found', 'status' => false));
}

?>