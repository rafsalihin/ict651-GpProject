<?php
// Function to calculate the total cost of items in the cart
function calculateTotalCost($cartItems) {
    $totalCost = 0;
    foreach ($cartItems as $item) {
        $totalCost += $item['price'] * $item['quantity'];
    }
    return $totalCost;
}

?>