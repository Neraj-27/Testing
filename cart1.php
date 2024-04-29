<?php

// Include your database connection code
require_once('connect.php');

// Include the getData function
require_once('getData.php');

session_start();

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Product has been Removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Add your CSS styles for the cart page here */
    </style>
</head>

<body>
    <h2>Shopping Cart</h2>
    <!-- Add your cart items display code here -->
    <?php
    // Check if cart is not empty
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        // Loop through cart items and display them
        foreach ($_SESSION['cart'] as $cartItem) {
            // Fetch product details from the database based on product_id
            $product_id = $cartItem['product_id'];
            // Call the getDataByCatId function from getData.php
            $productDetails = getDataByCatId($product_id);
            // Check if product details are retrieved successfully
            if ($productDetails) {
                // Display the product details
                echo "<div>";
                echo "<p>Product Name: " . $productDetails['product_name'] . "</p>";
                echo "<p>Product Price: $" . $productDetails['product_price'] . "</p>";
                // Add more product details as needed
                echo "</div>";
            } else {
                // Handle case where product details are not found
                echo "<p>Product details not found for product ID: $product_id</p>";
            }
        }
    } else {
        // Display message if cart is empty
        echo "<p>Your cart is empty</p>";
    }
    ?>

    <!-- Add your HTML for price details and other elements here -->

    <!-- Add your JavaScript code here if needed -->
</body>

</html>


<!--  --++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++>

