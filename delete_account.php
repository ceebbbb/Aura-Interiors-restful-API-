<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include "databaseConnect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['account_id'])) {
    echo json_encode(array('message' => 'Account ID is required', 'status' => false));
    exit;
}

$account_id = $data['account_id'];

$sql = "DELETE FROM accounts WHERE account_id = {$account_id}";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(array('message' => 'Account deleted successfully', 'status' => true));
    } else {
        echo json_encode(array('message' => 'Account not found', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'Failed to delete account: ' . mysqli_error($conn), 'status' => false));
}

?>