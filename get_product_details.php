<?php

header("Access-Control-Allow-Origin: *");
$response = ['success' => false, 'message' => 'Error Occured'];

require_once "dbconnect.php"; // Connect to the database

$productID = $_GET['product_id'];

$result = $conn->query("SELECT * FROM products WHERE id = $productID");

$count = mysqli_num_rows($result);

if ($result && $result->num_rows == 1) {
    $response['success'] = true;
    $response['message'] = 'Product successfully retrieved';
    $row = $result->fetch_assoc();
    $response['product'] = [
        'id'=>$row['id'],
        'name' => $row['name'],
        'description' => $row['description'],
        'type' => $row['category'],
        'price' => 'RM ' . $row['price'],
        'img' => $row['img']
    ];
}

header("Content-Type: application/json");
die(json_encode($response));
?>
