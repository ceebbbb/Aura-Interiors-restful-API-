<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

include "databaseConnect.php";

$sql = "SELECT * FROM accounts";
$result = mysqli_query($conn, $sql);

if (!$result) {
    echo json_encode(array('message' => 'SQL query failed', 'status' => false));
    exit;
}

if (mysqli_num_rows($result) > 0) {
    $output = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($output);
} else {
    echo json_encode(array('message' => 'No records found', 'status' => false));
}

?>