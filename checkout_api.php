<?php
// Include the dbconnect.php file
require_once 'dbconnect.php';

// Check if the form is submitted
function generateTrackingId()
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $trackingId = 'MY';
    $length = 8;

    for ($i = 0; $i < $length; $i++) {
        $trackingId .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $trackingId;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $paymentMethod = $_POST["payment_method"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $totalCost = $_POST["total_price"];

    // Generate a tracking ID
    $trackingId = generateTrackingId();

    // Prepare the SQL statement to insert the order details into the table
    $sql = "INSERT INTO orders (tracking_id, payment_method, name, email, address, total_price) VALUES ('$trackingId', '$paymentMethod', '$name', '$email', '$address', '$totalCost')";

    if ($conn->query($sql) === true) {
        // Order data inserted successfully

        // Clear the cart table
        $clearCartSql = "DELETE FROM cart";
        $conn->query($clearCartSql);

        // Prepare the response data
        $response = [
            "status" => true,
            "message" => "Order placed successfully",
            "tracking_id" => $trackingId
        ];

        // Redirect to orderconfirmed.php
        header("Location: orderconfirmed.php?tracking_id=" . $trackingId);
        exit();
    } else {
        // Error occurred while inserting the order data

        // Prepare the response data
        $response = [
            "status" => false,
            "message" => "Failed to place the order"
        ];
    }

    // Send the response as JSON
    header("Content-Type: application/json");
    echo json_encode($response);
}

// Close the database connection
$conn->close();
