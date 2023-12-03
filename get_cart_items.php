<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Include the database connection file
require_once "dbconnect.php";

// Prepare the SQL query to retrieve cart items with product image
$query = "SELECT c.id, c.product_id, c.product_name, c.price, c.quantity, p.img 
          FROM cart AS c
          JOIN products AS p ON c.product_id = p.id";

// Execute the query
$result = mysqli_query($conn, $query);

if ($result) {
    // Initialize an array to store the cart items
    $cartItems = array();

    // Fetch the cart items from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = array(
            "cart_id" => $row['id'],
            "product_id" => $row['product_id'],
            "product_name" => $row['product_name'],
            "price" => $row['price'],
            "quantity" => $row['quantity'],
            "img" => $row['img']
        );
    }

    // Return success response with the cart items
    http_response_code(200);
    echo json_encode(array("cartItems" => $cartItems, "status" => true));
} else {
    // Return error response
    http_response_code(500);
    echo json_encode(array("message" => "Failed to retrieve cart items", "status" => false));
}

// Close the database connection
mysqli_close($conn);
?>
