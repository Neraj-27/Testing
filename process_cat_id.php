<?php
// Start session

// Include your database connection code
require_once('connect.php');
require_once('getData.php');
// echo "test!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/stylecart.css">
    <link rel="stylesheet" href="css/stylecarditems.css">
    <link rel="stylesheet" href="style.css">

    <title>Category Page</title>
</head>
<body>
<!-- Sidebar -->
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <img src="img/2.png" alt="Logo">
            </button>
            <div class="sidebar-logo">
                <a href="#">Feast2U</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=1" class="sidebar-link" onclick="loadContentAndSubmitForm('starters.php', 1)">
                    <i class='bx bxs-cookie' ></i>
                    <span>Starters</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=2" class="sidebar-link" onclick="loadContentAndSubmitForm('drinks.php', 2)">
                    <i class='bx bx-beer'></i>                        
                    <span>Drinks & Beverages</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=3" class="sidebar-link" onclick="loadContentAndSubmitForm('breakfast.php', 3)">
                    <i class='bx bxs-bowl-hot'></i>                     
                    <span>Breakfast</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=4" class="sidebar-link" onclick="loadContentAndSubmitForm('lunch.php', 4)">
                    <i class='bx bxs-bowl-rice' ></i>              
                    <span>Lunch</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="process_cat_id.php?cat_id=5" class="sidebar-link" onclick="loadContentAndSubmitForm('dinner.php', 5)">
                    <i class='bx bxs-dish'></i>
                    <span>Dinner</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
            <div class="row justify-content-center">
                <div class="card-container my-3 ">
                    <?php
                        echo "<h2>Enjoy the</h2>";

                        // Check if cat_id is set in the URL parameter
                        if(isset($_GET['cat_id'])) {
                            // Retrieve the category ID from the URL parameter
                            $cat_id = $_GET['cat_id'];
                            $category_name = getCategoryName($cat_id); // You need to define this function
                            echo "<h2>$category_name</h2>";
                            $products = getDataByCatId($cat_id);
                            displayProductCards($products);
                            exit(); // Ensure that no further code is executed after the redirection
                        } else {
                            // Handle case where cat_id is not set
                            echo "Cat_id not set. Please select a category.";
                        }
                    ?>
                </div>
            </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<style>
/* Styles for the card container */
.card-container {
    display: inline-flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-around;
    padding: 20px;
    background-color:#f0f0f0;
    width:80%;
    justify-content: center; /* Center the container horizontally */
    align-items: center; /* Center the container vertically */
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
    color:orangered;
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

/* Sidebar Styles */
.wrapper {
    display: inline-flex;
    width: 100%;
    height: 100%;
}

#sidebar {
    position: fixed;
    width: 250px;
    height: 100%;
    background-color: #111;
    overflow-y: auto;
    z-index: 1000;
    transition: all 0.5s ease;
}

.sidebar-nav {
    padding: 0;
    margin: 0;
    list-style: none;
}

.sidebar-item {
    padding: 10px 15px;
    border-bottom: 1px solid #444;
}

.sidebar-item:last-child {
    border-bottom: none;
}

.sidebar-link {
    color: #ccc;
    text-decoration: none;
    display: block;
}

.sidebar-link:hover {
    color: #fff;
}

.sidebar-link i {
    margin-right: 10px;
}

.main-content {
    margin-left: 250px; /* Adjust this value to match the width of the sidebar */
    padding: 20px;
}
</style>
