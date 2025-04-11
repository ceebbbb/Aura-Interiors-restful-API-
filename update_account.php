<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, PATCH, POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include "databaseConnect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['account_id'])) {
    echo json_encode(array('message' => 'Account ID is required', 'status' => false));
    exit;
}

$account_id = $data['account_id'];

$update_fields = array();
if (isset($data['username'])) {
    $update_fields[] = "username = '{$data['username']}'";
}
if (isset($data['email'])) {
    $update_fields[] = "email = '{$data['email']}'";
}
if (isset($data['firstName'])) {
    $update_fields[] = "firstName = '{$data['firstName']}'";
}
if (isset($data['lastName'])) {
    $update_fields[] = "lastName = '{$data['lastName']}'";
}
if (isset($data['password'])) {
    $update_fields[] = "password = '{$data['password']}'";
}

$update_fields[] = "updated_at = '" . date('Y-m-d H:i:s') . "'";

if (count($update_fields) <= 1) { 
    echo json_encode(array('message' => 'No fields to update', 'status' => false));
    exit;
}

$sql = "UPDATE accounts SET " . implode(', ', $update_fields) . " WHERE account_id = {$account_id}";

if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(array('message' => 'Account updated successfully', 'status' => true));
    } else {
        echo json_encode(array('message' => 'No changes made or account not found', 'status' => false));
    }
} else {
    echo json_encode(array('message' => 'Failed to update account', 'status' => false));
}
?>