<?php

$t = $_GET["type"];
$t();

function filter_Product_by_Supplier()
{
    include_once("../Product/Product.php");
    $p = new Product();

    try {
        // Attempt to get products by supplier ID
        $products = $p->get_products_by_supplier_id($_GET["ee"]);

        // Check if products were retrieved successfully
        if ($products !== false) {
            // Encode and echo the products as JSON
            echo json_encode($products);
        } else {
            // Return an error response
            header('HTTP/1.1 500 Internal Server Error');
            echo "Error retrieving products.";
        }
    } catch (Exception $e) {
        // Handle any exceptions that might occur
        header('HTTP/1.1 500 Internal Server Error');
        echo "Exception: " . $e->getMessage();
    }
}
?>
