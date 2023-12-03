<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Page</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .boxes {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .boxes img {
            max-height: 200px; /* Adjust the maximum height as desired */
        }
    </style>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('form').on('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                // Get the search keyword
                var keyword = $('input[name="query"]').val();

                // Make AJAX request to get_product_search.php
                $.ajax({
                    url: 'get_product_search.php',
                    method: 'GET',
                    data: { query: keyword },
                    dataType: 'json',
                    success: function(response) {
                        // Handle the response and display search results
                        if (response.success) {
                            var products = response.products;

                            // Clear previous search results
                            $('#search-results').empty();

                            if (products.length > 0) {
                                // Append each product to the search results container
                                $.each(products, function(index, product) {
                                    var resultHtml = '<div class="boxes">' +
                                        '<h3><a href="product.php?id=' + product.id + '">' + product.name + '</a></h3>' +
                                        '<img src="img_item/' + product.img + '" alt="Product Image">' +
                                        '<p>' + product.description + '</p>' +
                                        '<p>Category: ' + product.type + '</p>' +
                                        '<p>Price: ' + product.price + '</p>' +
                                        '<hr>' +
                                        '</div>';

                                    $('#search-results').append(resultHtml);
                                });
                            } else {
                                $('#search-results').html('<p>No products found.</p>');
                            }
                        } else {
                            $('#search-results').html('<p>Error: ' + response.message + '</p>');
                        }
                    },
                    error: function() {
                        $('#search-results').html('<p>Error occurred while retrieving data.</p>');
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div style="padding: 20px;">
        <h1>Search Page</h1>
        <form>
            <input type="text" name="query" placeholder="Enter keyword">
            <button type="submit">Search</button>
        </form><br>
        <div id="search-results"></div>
    </div>    
</body>
</html>
<?php include 'footer.php'; ?>
