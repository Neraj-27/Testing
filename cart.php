<?php

// Include your database connection code
require_once('connect.php');

// Include the getData function
require_once('getData.php');

// session_start();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

<!-- Bootstrap CDN -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="css/stylecart.css">

</head>

<body>
    <!-- Add your cart items display code here -->
    
<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h2>My Cart</h2>
                <hr>
                    <!-- Add your cart items display code here -->
                <?php
                        function calculateTotal($cart) {
                            $total = 0;
                            foreach ($cart as $cartItem) {
                                $productDetails = getDataByProductId($cartItem['product_id']);
                                if ($productDetails) {
                                    $total += $productDetails['product_price'];
                                }
                            }
                            return $total;
                        }
                    
   
                        function getDataByProductId($product_id) {
                            global $con; // Assuming $con is your database connection variable

                            // Prepare and execute SQL query
                            $sql = "SELECT product_name, product_price, product_image FROM breakfast WHERE id = ?";
                            $stmt = mysqli_prepare($con, $sql);
                            if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "i", $product_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                // Check if there are any results
                                if ($result && mysqli_num_rows($result) > 0) {
                                    // Fetch data and return as array
                                    $row = mysqli_fetch_assoc($result);
                                    return $row;
                                } else {
                                    // No results found
                                    return false;
                                }
                            } else {
                                // Error preparing statement
                                return false;
                            }
                        }


                            // Check if cart is not empty
                            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                // Loop through cart items and display them
                                foreach ($_SESSION['cart'] as $cartItem) {
                                    // Fetch product details from the database based on product_id
                                    $product_id = $cartItem['product_id'];
                                    // Call the getDataByCatId function from getData.php
                                    $productDetails = getDataByProductId($product_id);
                                    // Check if product details are retrieved successfully
                                    if ($productDetails) {
                                        // Display the product details
                                        echo "  <form action=\"cart.php?action=remove&id=$product_id\" method=\"post\" class=\"cart-items\">";
                                            echo "<div class=\"border rounded\">";
                                                echo "  <div class=\"row bg-white\">";
                                                    echo " <div class=\"col-md-3 pl-0\">";
                                                        echo " <img src=\"{$productDetails['product_image']}\" alt=\"{$productDetails['product_name']}\" class=\"img-fluid card-img-top\"> ";
                                                    echo "</div>";
                                                    echo "<div class=\"col-md-6\">";                                
                                                        echo "<p>Product Name: " . $productDetails['product_name'] . "</p>";
                                                        echo "<h6>";
                                                        echo "<i class=\"fas fa-star\"></i>";
                                                        echo "<i class=\"fas fa-star\"></i>";
                                                        echo "<i class=\"fas fa-star\"></i>";
                                                        echo "<i class=\"fas fa-star\"></i>";
                                                        echo "<i class=\"far fa-star\"></i>";

                                                    echo "</h6>";
                                                            echo "<p>Product Price: $" . $productDetails['product_price'] . "</p>";
                                                            echo "<button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>";
                                                            // Inside the loop where you display cart items
                                                            echo "<button type=\"submit\" class=\"btn btn-success\">Update</button>";


                                                            // Add more product details as needed
                                                        echo "</div>";
                                                        echo "<div class=\"col-md-3 py-5\"> ";
                                                        echo "<div>";
                                                        echo "<button type=\"button\" class=\"btn bg-light border rounded-circle minus-btn\" data-id=\"$product_id\"><i class=\"fas fa-minus\"></i></button>";
                                                        echo "<input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline quantity-input\" id=\"quantity-$product_id\">";   
                                                        echo "<button type=\"button\" class=\"btn bg-light border rounded-circle plus-btn\" data-id=\"$product_id\"><i class=\"fas fa-plus\"></i></button>";
                                                        echo "</div>";
                                                    echo "</div>" ;
                                                echo "</div>";
                                        echo "</form>";
                                    } else {
                                        // Handle case where product details are not found
                                        echo "<p>Product details not found for product ID: $product_id</p>";
                                    }
                                }
                            } else {
                                // Display message if cart is empty
                                echo "<p>Your cart is empty</p>";
                            }
                                                                    // JavaScript to handle button clicks
                                        echo "<script>";
                                        echo "document.addEventListener('DOMContentLoaded', function() {";
                                        echo "  const plusButtons = document.querySelectorAll('.plus-btn');";
                                        echo "  const minusButtons = document.querySelectorAll('.minus-btn');";
                                        echo "  plusButtons.forEach(button => {";
                                        echo "    button.addEventListener('click', function() {";
                                        echo "      const productId = this.getAttribute('data-id');";
                                        echo "      const inputField = document.getElementById('quantity-' + productId);";
                                        echo "      let quantity = parseInt(inputField.value);";
                                        echo "      quantity++;";
                                        echo "      inputField.value = quantity;";
                                        echo "    });";
                                        echo "  });";
                                        echo "  minusButtons.forEach(button => {";
                                        echo "    button.addEventListener('click', function() {";
                                        echo "      const productId = this.getAttribute('data-id');";
                                        echo "      const inputField = document.getElementById('quantity-' + productId);";
                                        echo "      let quantity = parseInt(inputField.value);";
                                        echo "      if (quantity > 1) {";
                                        echo "        quantity--;";
                                        echo "        inputField.value = quantity;";
                                        echo "      }";
                                        echo "    });";
                                        echo "  });";
                                        echo "});";
                                        echo "</script>";
                                        // script for update button 
                                        echo "<script>";
                                        echo "document.addEventListener('DOMContentLoaded', function() {";
                                        echo "  const updateButton = document.querySelector('.update-btn');";
                                        echo "  updateButton.addEventListener('click', function() {";
                                        echo "    let total = 0;";
                                        echo "    const quantityInputs = document.querySelectorAll('.quantity-input');";
                                        echo "    quantityInputs.forEach(input => {";
                                        echo "      const quantity = parseInt(input.value);";
                                        echo "      const price = parseFloat(input.getAttribute('data-price'));";
                                        echo "      if (!isNaN(quantity) && !isNaN(price)) {";
                                        echo "        total += quantity * price;";
                                        echo "      }";
                                        echo "    });";
                                        echo "    const totalElement = document.getElementById('total-amount');";
                                        echo "    totalElement.textContent = '$' + total.toFixed(2);"; // Update total amount displayed
                                        echo "  });";
                                        echo "});";
                                        echo "</script>";


                ?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>PRICE DETAILS</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            }else{
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                    </div>
                    <div class="col-md-6">
                        <?php
                        // Calculate total amount payable
                        $total = calculateTotal($_SESSION['cart']);
                        ?>
                            <h6>Total Amount: <span id="total-amount">$<?php echo $total; ?></span></h6>

                        <h6>₹<?php echo $total; ?></h6>
                        <h6 class="text-success">FREE</h6>
                        <hr>
                        <h6>₹<?php echo $total; ?></h6>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- Add your HTML for price details and other elements here -->

    <!-- Add your JavaScript code here if needed -->
</body>

</html>