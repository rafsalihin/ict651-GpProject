<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Tracking</title>
    <style>
        .order-form {
            max-width: 400px;
            margin: 20px auto;
        }
        .order-form input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .order-form button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .order-details {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            text-align: center;
        }
        .order-details h2 {
            margin-bottom: 10px;
        }
        .order-details p {
            margin-bottom: 20px;
        }
        .order-details strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="order-form">
        <h1>Order Tracking</h1>
        <form action="track_order.php" method="GET">
            <input type="text" name="tracking_id" placeholder="Enter Tracking ID" required>
            <button type="submit">Track Order</button>
        </form>
    </div>

    <div class="order-details">
        <h2>Order Details</h2>
        <?php
        // Check if the tracking ID is present in the URL
        require_once 'dbconnect.php';
        if (isset($_GET['tracking_id'])) {
            $trackingId = $_GET['tracking_id'];

            // Retrieve order details from the database based on the tracking ID
            $sql = "SELECT * FROM orders WHERE tracking_id = '$trackingId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $order = $result->fetch_assoc();

                if ($order !== null) {
                    // Display order details
                    echo '<p>Thank you for your order!<br> A copy of invoice and tracking ID is sent to your email.</p>';
                    echo '<p>Order Details:</p>';
                    echo '<p><strong>Tracking ID:</strong> ' . $order['tracking_id'] . '</p>';
                    echo '<p><strong>Status:</strong> ' . $order['order_status'] . '</p>';
                    echo '<p><strong>Name:</strong> ' . $order['name'] . '</p>';
                    echo '<p><strong>Email:</strong> ' . $order['email'] . '</p>';
                    echo '<p><strong>Address:</strong> ' . $order['address'] . '</p>';
                    echo '<p><strong>Total Paid:</strong> RM ' . $order['total_price'] . '</p>';

                    // Display any other relevant order information
                } else {
                    echo '<p>Order not found.</p>';
                }
            } else {
                echo '<p>Order not found.</p>';
            }
        } else {
            echo '<p>Invalid tracking ID.</p>';
        }
        ?>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>
