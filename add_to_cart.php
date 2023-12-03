<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the request body
    $productId = $_POST['id'];
    $quantity = $_POST['quantity'];

    // Validate the received data
    if (isset($productId) && isset($quantity)) {
        // Include the database connection file
        require_once 'dbconnect.php';

        // Prepare the SQL query
        $query = "INSERT INTO cart (product_id, product_name, price, quantity) 
        SELECT id, name, price, $quantity FROM products 
        WHERE id = $productId";
        // Execute the query
        if (mysqli_query($conn, $query)) {
            // Return success response
            http_response_code(200);
            echo json_encode(array("message" => "Item added to cart successfully", "status" => true));
            header("Location: cart.php");
        } else {
            // Return error response
            http_response_code(500);
            echo json_encode(array("message" => "Failed to add item to cart", "status" => false));
        }
    } else {
        // Return error response
        http_response_code(400);
        echo json_encode(array("message" => "Invalid request data", "status" => false));
    }
} else {
    // Return error response for invalid request method
    http_response_code(405);
    echo json_encode(array("message" => "Invalid request method", "status" => false));
}
