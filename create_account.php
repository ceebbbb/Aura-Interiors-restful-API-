<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include "databaseConnect.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username']) || !isset($data['email']) || !isset($data['password']) || !isset($data['firstName']) || !isset($data['lastName'])) {
    echo json_encode(array(
        'message' => 'Username, email, password, first name, and last name are required',
        'status' => false
    ));
    exit;
}

$username = $data['username'];
$email = $data['email'];
$firstName = $data['firstName'];
$lastName = $data['lastName'];
$password = $data['password'];
$created_at = date('Y-m-d H:i:s');

$check_sql = "SELECT * FROM accounts WHERE username = '{$username}' OR email = '{$email}'";
$check_result = mysqli_query($conn, $check_sql);

if (!$check_result) {
    echo json_encode(array(
        'message' => 'SQL query failed',
        'status' => false
    ));
    exit;
}

if (mysqli_num_rows($check_result) > 0) {
    echo json_encode(array(
        'message' => 'Username or email already exists',
        'status' => false
    ));
    exit;
}

$sql = "INSERT INTO accounts (username, email, firstName, lastName, password, created_at) 
        VALUES ('{$username}', '{$email}', '{$firstName}', '{$lastName}', '{$password}', '{$created_at}')";

if ($result = mysqli_query($conn, $sql)) {
    echo json_encode(array(
        'message' => 'Account created successfully', 
        'status' => true,
        'account_id' => mysqli_insert_id($conn)
    ));
} else {
    echo json_encode(array(
        'message' => 'Failed to create account',
        'status' => false
    ));
}

?>