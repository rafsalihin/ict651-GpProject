<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    // Validate the received data
    if (isset($cartId) && isset($quantity)) {
        // Include the database connection file
        require_once 'dbconnect.php';

        // Prepare the SQL query
        $query = "UPDATE cart SET quantity = '$quantity' WHERE id = '$cartId'";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            // Return success response
            http_response_code(200);
            echo json_encode(array("message" => "Cart updated successfully", "status" => true));
            header("Location: cart.php");
        } else {
            // Return error response with detailed error message
            $errorMessage = mysqli_error($conn);
            http_response_code(500);
            echo json_encode(array("message" => "Unable to update cart: " . $errorMessage, "status" => false));
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Return error response for invalid data
        http_response_code(400);
        echo json_encode(array("message" => "Invalid data", "status" => false));
    }
} else {
    // Return error response for invalid request method
    http_response_code(405);
    echo json_encode(array("message" => "Invalid request method", "status" => false));
}
?>
