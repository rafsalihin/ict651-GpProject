<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Cart</title>
    <style>
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #dddddd;
            padding-bottom: 10px;
            cursor: pointer;
        }
        .cart-item img {
            max-width: 100px;
            margin-right: 20px;
        }
        .cart-item-details {
            flex-grow: 1;
        }
        .cart-item-details h2 {
            margin-top: 0;
            margin-bottom: 5px;
            color: blue;
            text-decoration: underline;
        }
        .cart-item-details p {
            margin: 0;
        }
        .cart-item-quantity {
            display: flex;
            align-items: center;
        }
        .cart-item-quantity input[type="number"] {
            width: 50px;
            margin-right: 10px;
        }
        .cart-item-price {
            width: 100px;
            text-align: right;
        }
        .cart-total {
            margin-top: 20px;
            text-align: right;
        }
        .cart-total p {
            margin-bottom: 5px;
        }
        .cart-total h3 {
            margin-top: 0;
        }
        .cart-actions {
            text-align: right;
            margin-top: 20px;
        }
        .cart-actions a {
            display: inline-block;
            margin-left: 10px;
            padding: 8px 12px;
            background-color: #333333;
            color: #ffffff;
            text-decoration: none;
        }
        .remove-link {
            color: red;
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid red;
            border-radius: 4px;
        }

        .update-link {
            color: green;
            display: inline-block;
            padding: 5px 10px;
            border: 1px solid green;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Cart</h1>

    <div class="cart-container">
        <?php
        // Retrieve cart items from the API
        $response = file_get_contents("http://localhost/courts/get_cart_items.php");
        $responseData = json_decode($response, true);

        if ($responseData['status']) {
            $cartItems = $responseData['cartItems'];

            // Check if cart is not empty
            if (count($cartItems) > 0) {
                echo '<div class="cart-items">';
                foreach ($cartItems as $item) {
                    echo '<div class="cart-item">';
                    echo '<img src="img_item/'.$item['img'].  '"alt="Product Image">';
                    echo '<div class="cart-item-details">';
                    echo '<h2><a href="product.php?id=' . $item['product_id'] . '">' . $item['product_name'] . '</a></h2>';
                    echo '<p>Price:RM '. $item['price'] . '</p>';
                    echo '<form action="update_cart.php" method="post">';
                    echo '<div class="cart-item-quantity">';
                    echo '<p>Quantity:</p>';
                    echo '<input type="number" name="quantity" value="' . $item['quantity'] . '" min="1" data-cart-id="' . $item['cart_id'] . '">';
                    echo '<input type="hidden" name="cart_id" value="' . $item['cart_id'] . '">';
                    
                    echo '</div>';
                    echo '<input type="submit" value="Update" class="update-link">';
                    echo '</form>';
                    echo '<a href="remove_from_cart.php?id=' . $item['cart_id'] . '" class="remove-link">Remove</a>';
                    echo '</div>';
                    echo '<div class="cart-item-price">';
                    echo '<p>Total: RM '. ($item['price'] * $item['quantity']) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';

                echo '<div class="cart-total">';
                echo '<h3>Total: RM '. calculateTotalCost($cartItems) . '</h3>';
                echo '</div>';

                echo '<div class="cart-actions">';
                echo '<a href="checkout.php">Proceed to Checkout</a>';
                echo '</div>';
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
