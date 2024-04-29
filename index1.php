<?php
include 'connect.php'; // Ensure 'connect.php' contains your database connection code

// Function to escape HTML characters
function escapeHTML($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

$searchResults = ''; // Initialize variable to hold search results HTML

if(isset($_POST['submit'])){
    $search = $_POST['search'];

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT * FROM `breakfast` WHERE cat_id LIKE ? OR product_name LIKE ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        $param = "%$search%";
        mysqli_stmt_bind_param($stmt, "ss", $param, $param);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Build HTML for each search result
                    $searchResults .= '<div class="card">';
                    $searchResults .= '<div class="card shadow">';
                    $searchResults .= '<img src="' . escapeHTML($row['product_image']) . '" class="card-img-top" alt="' . escapeHTML($row['product_name']) . '" style="max-width: 200px; max-height: 200px;">';
                    $searchResults .= '</div>';
                    $searchResults .= '<div class="card-body">';
                    $searchResults .= '<h5 class="card-title">' . escapeHTML($row['product_name']) . '</h5>';
                    $searchResults .= ' <h6>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </h6>';
                    $searchResults .= '<p class="card-text">₹' . escapeHTML($row['product_price']) . '</p>';
                    $searchResults .= '<button class="btn btn-warning add-to-cart-btn" data-product-id="' . escapeHTML($row['id']) . '">Add to Cart</button>';
                    $searchResults .= '</div></div>';
                }
            } else {
                $searchResults = '<div class="col"><h2 class="text-danger">Sorry!!... We regret to inform you that the specified dish is not available at our restaurant.</h2></div>';
            }
        } else {
            $searchResults = '<div class="col"><h2 class="text-danger">Error executing query</h2></div>';
        }
    } else {
        $searchResults = '<div class="col"><h2 class="text-danger">Error preparing statement</h2></div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

     <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="css/style2.css"> 
    <link rel="stylesheet" href="css/style.css">  -->


</head>
<body>
<?php require_once ("php/header.php"); ?>


        <!-- Include sidebar -->
        <?php require_once ("php/sidebar.php"); ?>
        <div id="selectedCatIdDisplay"></div>


        <!-- Display breakfast items -->
        <?php
        // Check if cat_id is set in the URL
        if(isset($_GET['cat_id'])) {
            $cat_id = $_GET['cat_id'];
            $sql = "SELECT * FROM breakfast WHERE cat_id = $cat_id";
            $result = mysqli_query($database->con, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    component1($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                }
            } else {
                echo "<div class='col-md-12'><h4>No items found in this category.</h4></div>";
            }
        } else {
            // echo "<div class='col-md-12'><h4>Please select a category from the sidebar.</h4></div>";
        }
        ?>
 
<!-- Scripts -->
<script src="script.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- <script>
    var selectedCatId;

    function loadContentAndSubmitForm(page, cat_id) {
        document.getElementById("selectedCatIdInput").value = cat_id;
        document.getElementById("catIdForm").submit();
        loadContent(page, cat_id);
        document.getElementById("selectedCatIdDisplay").innerText = "Selected Category ID: " + cat_id;
    }

    function updateSelectedCatId(cat_id) {
        document.getElementById("selectedCatIdInput").value = cat_id;
        document.getElementById("catIdForm").submit();
        document.getElementById("selectedCatIdDisplay").innerText = "Selected Category ID: " + cat_id;
    }

    function loadContent(page, cat_id) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", page, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("content").innerHTML = xhr.responseText;
                selectedCatId = cat_id;
                echo $selectedCatId;
            }
        };
        xhr.send();
    }
</script> -->
<script>
    function loadContentAndSubmitForm(page, cat_id) {
        document.getElementById("selectedCatIdDisplay").innerText = "Selected Category ID: " + cat_id;
        document.getElementById("selectedCatIdInput").value = cat_id;
        document.getElementById("catIdForm").submit();
        loadContent(page);
    }

    function loadContent(page) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", page, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("content").innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    }
</script>

</body>
</html>
