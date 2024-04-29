<?php

// Include your database connection code
require_once('connect.php');
global $con; // Assuming $con is your database connection variable

function getData($cat_id)
    {

    if(isset($_GET['cat_id'])) {
        // Retrieve the category ID from the URL parameter
        $cat_id = $_GET['cat_id'];

        // Execute SQL query to fetch breakfast items based on the category ID
        $query = "SELECT * FROM {$this->tablename} WHERE cat_id = $cat_id";
        $result = mysqli_query($this->con, $query); // Assuming $connection is your database connection object

        // Check if the query execution was successful
        if($result) {
            // Check if any breakfast items are found for the selected category
            if(mysqli_num_rows($result) > 0) {
                // Iterate over the result set and display breakfast items
                while($row = mysqli_fetch_assoc($result)) {
                    // Display breakfast item details as cards
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>{$row['product_name']}</h5>";
                    echo "<p class='card-text'>Price: {$row['product_price']}</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                // Handle case where no breakfast items are found for the selected category
                echo "No breakfast items found for the selected category.";
            }
        } else {
            // Handle SQL query execution error
            echo "Error executing the SQL query: " . mysqli_error($this->con);
        }
    } else {
        // Handle case where category ID is not set or invalid
        echo "Cat_id not set. Please select a category.";
    }
}
// Function to fetch data based on cat_id
function getDataByCatId($cat_id) {
    global $con; // Assuming $con is your database connection variable


    // ==============================================================================
    

    // ==============================================================================


    global $con; // Assuming $con is your database connection variable

    // Prepare and execute SQL query
    $sql = "SELECT id, product_name, product_price, product_image FROM breakfast WHERE cat_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if there are any results
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch data and return as array
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            // No results found
            return array();
        }
    } else {
        // Error preparing statement
        return array();
    }
}

// Example usage:
$cat_id = 3; // Example cat_id, replace with your actual value
$data = getDataByCatId($cat_id);
print_r($data); // Print fetched data
?>




<!-- getData(4:40)+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->


<?php

// Include your database connection code
require_once('connect.php');
global $con; // Assuming $con is your database connection variable

// Function to fetch data based on cat_id
function getDataByCatId($cat_id) {
    global $con; // Assuming $con is your database connection variable

    // Prepare and execute SQL query
    $sql = "SELECT id, product_name, product_price, product_image FROM breakfast WHERE cat_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if there are any results
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch data and return as array
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            // No results found
            return array();
        }
    } else {
        // Error preparing statement
        return array();
    }
}

// Function to display product cards
function displayProductCards($products) {
    foreach ($products as $product) {
        component1($product['product_name'], $product['product_price'], $product['product_image'], $product['id']);
    }
}

// Function to render component1
function component1($productname, $productprice, $productimg, $productid) {
    $element = "
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"index1.php\" method=\"post\">
            <div class=\"card shadow\" >
                <div>
                    <img src=\"$productimg\" alt=\"Indian Famous Thali\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <h6>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"far fa-star\"></i>
                    </h6>
                    <p class=\"card-text\">
                        Some quick example text to build on the card.
                    </p>
                    <h5>
                        <small><s class=\"text-secondary\">$519</s></small>
                        <span class=\"price\">$productprice</span>
                    </h5>
                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
            </div>
        </form>
    </div>";

    echo $element; // This line was added to echo the HTML content
}

// Example usage:
$cat_id = 1; // Assuming the selected cat_id is 1
$products = getDataByCatId($cat_id);
displayProductCards($products);


?>




<!-- //////////////////////////////////////getData for cartphp////////////////////////////// -->
<?php

// Include your database connection code
require_once('connect.php');
global $con; // Assuming $con is your database connection variable

// Function to fetch data based on cat_id
function getDataByCatId($cat_id) {
    global $con; // Assuming $con is your database connection variable

    // Prepare and execute SQL query
    $sql = "SELECT id, product_name, product_price, product_image FROM breakfast WHERE cat_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if there are any results
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch data and return as array
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            // No results found
            return array();
        }
    } else {
        // Error preparing statement
        return array();
    }
}

// Function to display product cards
function displayProductCards($products) {
    foreach ($products as $product) {
        component1($product['product_name'], $product['product_price'], $product['product_image'], $product['id']);
    }
}

// Function to render component1
function component1($productname, $productprice, $productimg, $productid) {
    $element = "
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"index1.php\" method=\"post\">
            <div class=\"card shadow\" >
                <div>
                    <img src=\"$productimg\" alt=\"Indian Famous Thali\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <h6>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"far fa-star\"></i>
                    </h6>
                    <p class=\"card-text\">
                        Some quick example text to build on the card.
                    </p>
                    <h5>
                        <small><s class=\"text-secondary\">$519</s></small>
                        <span class=\"price\">$productprice</span>
                    </h5>
                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
            </div>
        </form>
    </div>";

    echo $element; // This line was added to echo the HTML content
}

// Example usage:
$cat_id = $_GET['cat_id']; // Get the cat_id from the URL parameter
echo 'selected cat_ID::::::::::::::::::::::::::'.$cat_id;
$products = getDataByCatId($cat_id);
displayProductCards($products);
?>


<style>
/* Styles for the card container */
.card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-around;
    padding: 20px;
}

/* Styles for individual cards */
.card {
    width: 250px;
    background-color: #eee;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease;
}

/* Styles for card image */
.card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Styles for card body */
.card-body {
    padding: 20px;
}

/* Styles for card title */
.card-title {
    font-size: 18px;
    margin-bottom: 10px;
}

/* Styles for card text */
.card-text {
    font-size: 16px;
    color: rebeccapurple;
}

/* Hover effect for card */
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
</style>
<!-- ===============================////////////////////////////////////=============================== -->
<?php
// Start session
session_start();

// Function to add product to cart
function addToCart($product_id) {
    // Check if cart session variable is set
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");
        // Check if product is already in the cart
        if (in_array($product_id, $item_array_id)) {
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        } else {
            // Add product to cart
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $product_id
            );
            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        // If cart session variable is not set, create a new session variable
        $item_array = array(
            'product_id' => $product_id
        );
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}

// Handle adding product to cart if form is submitted
if (isset($_POST['add'])) {
    addToCart($_POST['product_id']);
}

// Include your database connection code
require_once('connect.php');
global $con; // Assuming $con is your database connection variable

// Function to fetch data based on cat_id
function getDataByCatId($cat_id) {
    global $con; // Assuming $con is your database connection variable

    // Prepare and execute SQL query
    $sql = "SELECT id, product_name, product_price, product_image FROM breakfast WHERE cat_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $cat_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if there are any results
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch data and return as array
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        } else {
            // No results found
            return array();
        }
    } else {
        // Error preparing statement
        return array();
    }
}

// Function to display product cards
function displayProductCards($products) {
    foreach ($products as $product) {
        component1($product['product_name'], $product['product_price'], $product['product_image'], $product['id']);
    }
}

// Function to render component1
function component1($productname, $productprice, $productimg, $productid) {
    $element = "
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"\" method=\"post\"> <!-- Removed action attribute -->
            <div class=\"card shadow\">
                <div>
                    <img src=\"$productimg\" alt=\"Indian Famous Thali\" class=\"img-fluid card-img-top\">
                </div>
                <div class=\"card-body\">
                    <h5 class=\"card-title\">$productname</h5>
                    <h6>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"fas fa-star\"></i>
                        <i class=\"far fa-star\"></i>
                    </h6>
                    <h5>
                        <small><s class=\"text-secondary\">$519</s></small>
                        <span class=\"price\">$productprice</span>
                    </h5>
                    <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                    <input type='hidden' name='product_id' value='$productid'>
                </div>
            </div>
        </form>
    </div>";

    echo $element; // This line was added to echo the HTML content
}

// Example usage:
$cat_id = $_GET['cat_id']; // Get the cat_id from the URL parameter
echo 'selected cat_ID::::::::::::::::::::::::::'.$cat_id;
$products = getDataByCatId($cat_id);
displayProductCards($products);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="css/stylecart.css">
    <title>cartmenu</title>
</head>
<body>
<header id="header">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

        <button class="navbar-toggler"
            type="button"
                data-toggle="collapse"
                data-target = "#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="mr-auto"></div>
            <div class="navbar-nav">
                <a href="cart.php" class="nav-item nav-link active">
                    <h5 class="px-5 cart">
                        <i class="fas fa-shopping-cart"></i> Cart
                        <?php
                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class=\"text-primary bg-light\">$count</span>";
                        } else {
                            echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                        }
                        ?>
                    </h5>
                </a>
            </div>
        </div>
    </nav>
</header>
</body>
</html>

<style>
/* Styles for the card container */
.card-container {
    display: inline-block;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-around;
    padding: 20px;
}

/* Styles for individual cards */
.card {
    width: 250px;
    background-color: #eee;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s
