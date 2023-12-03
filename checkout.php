<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <style>
        .checkout-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .checkout-form {
            margin-top: 20px;
        }
        .checkout-form label {
            display: block;
            margin-bottom: 10px;
        }
        .checkout-form input[type="text"],
        .checkout-form input[type="email"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        .checkout-form button {
            padding: 8px 12px;
            background-color: #333333;
            color: #ffffff;
            border: none;
            cursor: pointer;
        }
        /* Add styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        // Submit the payment form
        function submitPaymentForm() {
            // Retrieve the selected payment method
            var paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

            // Get customer details from the checkout form
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var address = document.getElementById("address").value;
            var totalCost = <?php echo calculateTotalCost($cartItems); ?>;

            // Perform client-side validation
            if (name.trim() === '') {
                alert("Please enter your name.");
                return;
            }

            if (email.trim() === '') {
                alert("Please enter your email.");
                return;
            }

            if (address.trim() === '') {
                alert("Please enter your address.");
                return;
            }

            // Prepare the data to be sent to the API
            var data = {
                payment_method: paymentMethod,
                name: name,
                email: email,
                address: address,
                total_price: totalCost
            };

            // Call the checkout API with the payment data
            fetch("checkout_api.php", {
                method: "POST",
                body: JSON.stringify(data),
                headers: {
                    "Content-Type": "application/json"
                }
            })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.status) {
                        // Checkout successful, redirect to order confirmation page with tracking ID
                        window.location.href = "orderconfirmed.php?tracking_id=" + data.tracking_id;
                    } else {
                        // Checkout failed, display error message
                        alert(data.message);
                    }
                })
                .catch(function(error) {
                    console.error("Error:", error);
                });
        }
    </script>
</head>
<body>
    <h1>Checkout</h1>

    <div class="checkout-container">
        <h2>Invoice</h2>
        <?php
        // Retrieve cart items from the API
        $response = file_get_contents("http://localhost/courts/get_cart_items.php");
        $responseData = json_decode($response, true);

        if ($responseData['status']) {
            $cartItems = $responseData['cartItems'];

            // Check if cart is not empty
            if (count($cartItems) > 0) {
                echo '<table>';
                echo '<tr>';
                echo '<th>Product Name</th>';
                echo '<th>Price</th>';
                echo '<th>Quantity</th>';
                echo '<th>Total</th>';
                echo '</tr>';

                foreach ($cartItems as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['product_name'] . '</td>';
                    echo '<td>RM ' . $item['price'] . '</td>';
                    echo '<td>' . $item['quantity'] . '</td>';
                    echo '<td>RM' . ($item['price'] * $item['quantity']) . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
                echo '<p><strong>Total: RM ' . calculateTotalCost($cartItems) . '</strong></p>';

                echo '<div class="checkout-form">';
                echo '<h2>Customer Details</h2>';
                echo '<form id="checkoutForm" action="checkout_api.php" method="POST">';
                echo '<label for="name">Name:</label>';
                echo '<input type="text" id="name" name="name" required>';

                echo '<label for="email">Email:</label>';
                echo '<input type="email" id="email" name="email" required>';

                echo '<label for="address">Address:</label>';
                echo '<input type="text" id="address" name="address" required>';

                echo '<input type="hidden" id="total_price" name="total_price" value="' . calculateTotalCost($cartItems) . '">';

                echo '<label>';
                echo '<input type="radio" name="payment_method" value="credit_card">';
                echo 'Credit Card';
                echo '</label>';

                echo '<label>';
                echo '<input type="radio" name="payment_method" value="paypal">';
                echo 'PayPal';
                echo '</label>';

                // Add more payment options as needed

                echo '<button type="submit">Proceed to Payment</button>';
                
                echo '</form>';
                echo '</div>';
                echo '<a href="'. $_SERVER['HTTP_REFERER'].'" class="back-button">Back to Previous</a>';

            } else {
                echo '<p>Your shopping cart is empty.</p>';
            }
        } else {
            echo '<p>Error: ' . $responseData['message'] . '</p>';
        }
        ?>
    </div>

</body>
</html>
<?php include 'footer.php'; ?>
