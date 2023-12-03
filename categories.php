<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Listing</title>
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            padding: 20px; /* Add padding outside the grid */
        }

        .product-details {
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px; /* Add padding inside the boxes */
        }

        .product-details img {
            max-height: 150px; /* Set the maximum height for the product images */
        }
    </style>
</head>
<body>
    

    <?php
    if (!empty($_GET['product_category'])) {
        $productCategory = $_GET['product_category'];

        // Make the API request to retrieve products based on the product category
        $apiUrl = 'http://localhost/courts/get_product_by_categories.php?product_category=' . urlencode($productCategory);
        $apiResponse = @file_get_contents($apiUrl);

        if ($apiResponse !== false) {
            $products = json_decode($apiResponse, true);
            echo '<h1>Product Listing</h1>';
            if (isset($products['success']) && $products['success']) {
                echo '<div class="product-grid">';
                foreach ($products['products'] as $product) {
                    echo '<a href="product.php?id=' . $product['id'] . '" class="product-details">';
                    echo '<div>';
                    echo '<img src="img_item/'.$product['img'].  '"alt="Product Image">';
                    echo '<h3>' . $product['name'] . '</h3>';
                    echo '<p>Price: ' . $product['price'] . '</p>';
                    echo '</div>';
                    echo '</a>';
                }
                echo '</div>';
            } else {
                echo 'Error: ' . (isset($products['message']) ? $products['message'] : 'Unknown error');
            }
        } else {
            echo 'Error: Failed to retrieve data from the API.';
        }
    } else {
        echo 'No product category specified.';
    }
    ?>

</body>
</html>
<?php include 'footer.php'; ?>
