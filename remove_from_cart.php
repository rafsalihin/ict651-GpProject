<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorization");

// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve cart ID from the query parameters
    $cartId = $_GET['id'];

    // Validate the received data
    if (isset($cartId)) {
        // Include the database connection file
        require_once 'dbconnect.php';

        // Prepare the SQL query
        $query = "DELETE FROM cart WHERE id = '$cartId'";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            // Return success response
            http_response_code(200);
            echo json_encode(array("message" => "Item removed from cart successfully", "status" => true));
            header("Location: cart.php");
        } else {
            // Return error response
            http_response_code(500);
            echo json_encode(array("message" => "Failed to remove item from cart", "status" => false));
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
?>
