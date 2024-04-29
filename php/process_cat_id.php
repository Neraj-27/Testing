<?php
// process_cat_id.php
require_once('getData.php');


if (isset($_GET['cat_id'])) {
    $catId = $_GET['cat_id'];
    // Fetch items from database based on cat_id
    $items = $db->fetchItemsByCategoryId($catId);
    echo json_encode($items);
}
echo 'hiiiiiiiiiiiiiiiiiiiiiiiiii';
$cat_id = 1; // Example cat_id, replace with your actual value
$data = getData($cat_id);
print_r($data);

?>
