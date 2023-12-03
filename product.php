<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <style>
        .product-details {
            display: flex;
            justify-content: center;
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            border: 1px solid #dddddd;
        }
        .product-details img {
            max-width: 200px;
            margin-right: 20px;
        }
        .product-details-text {
            text-align: left;
        }
        .add-to-cart-form {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        .add-to-cart-form input[type="number"] {
            width: 50px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h1>Product Details</h1>

    <?php
    if (isset($_GET['id'])) {
        $response = file_get_contents("http://localhost/courts/get_product_details.php?product_id=" . urlencode($_GET['id']));
        $responseData = json_decode($response, true);

        if ($responseData['success']) {
            $product = $responseData['product'];

            $id = $product['id'];
            $name = $product['name'];
            $description = $product['description'];
            $type = $product['type'];
            $price = $product['price'];
            $img = $product['img'];
        } else {
            $error = $responseData['message'];
        }
    }
    ?>
<div><p href="'categories.php?product_category'.">
    <div class="product-details">
        <img src="img_item/<?php echo $img?>" alt="Product Image">
        <div class="product-details-text">
            <?php if (isset($name)): ?>
                <h1><?php echo $name; ?></h1>
                <p>Price: <?php echo $price; ?></p>
                <p>Category: <?php echo $type; ?></p>
                <p><?php echo $description; ?></p>
                <form class="add-to-cart-form" method="post" action="add_to_cart.php">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="number" name="quantity" value="1" min="1">
                    <input type="submit" value="Add to Cart">
                </form>
                <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="back-button">Back to Previous</a>
            <?php elseif (isset($error)): ?>
                <p>Error: <?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>
            </div>
</body>
</html>
<?php include 'footer.php'; ?>
