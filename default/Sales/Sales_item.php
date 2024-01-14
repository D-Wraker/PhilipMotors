<?php

class SalesItem
{

    public $sale_id;
    public $Item_id;
    public $Sale_id;
    public $product_id;
    public $Item_Quantity;
    public $Item_Price;
    public $Item_Discount;
    public $Item_Amount;
    public $Item_Status;
    public $Item_Timestamp;


    public $Product_Name;
    private $db;
 


    function __construct()
{

    $this->db = new mysqli(host, un, password, db); // create database connection 
}





function insert_sales_items($sale_id)
{

    $sales_item_list = 0;
    // Check if Item_id is set and is an array
    if (isset($_POST["Item_id"]) && is_array($_POST["Item_id"])) {
        foreach ($_POST["Item_id"] as $salesItem) {
            $product_id = $_POST["Item_id"][$sales_item_list];
            $quantity = $_POST["Item_Quantity"][$sales_item_list];
            $item_price = $_POST["Item_Price"][$sales_item_list];
            $discount = $_POST["Item_Discount"][$sales_item_list];
            $item_amount = $_POST["Item_Amount"][$sales_item_list];

            // Insert into sales_items table
            $sql = "INSERT INTO sales_items (sale_id, Sales_Product_id, quantity, item_price, discount, item_amount) 
                    VALUES ('$sale_id', '$product_id', '$quantity', '$item_price', '$discount', '$item_amount')";
            $this->db->query($sql);

            // Update stock table
            $this->update_stock($product_id, $quantity);

            // Debugging line to print the SQL query
            // echo $sql;

            $sales_item_list++;
        }
    } else {
        // Handle the case where Item_id is not set or is not an array
        echo "No items to insert.";
    }

    return true;
}

function update_stock($product_id, $quantity)
{
    // Check if the product exists in the stock table
    $existing_quantity = $this->get_stock_quantity($product_id);

    if ($existing_quantity !== false) {
        // Update the existing stock quantity
        $new_quantity = $existing_quantity - $quantity;
        $sql = "UPDATE stock SET quantity_in_stock = '$new_quantity' WHERE product_id = '$product_id'";
        $this->db->query($sql);
        // Debugging line to print the SQL query
        echo $sql;
    } else {
        // Handle the case where the product doesn't exist in stock (optional)
        // You may want to log this event or handle it based on your requirements
        echo "Product not found in stock.";
    }
}

function get_stock_quantity($product_id)
{
    // Retrieve the current stock quantity for a given product
    $sql = "SELECT quantity_in_stock FROM stock WHERE product_id = '$product_id'";
    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['quantity_in_stock'];
    } else {
        return false; // Product not found in stock
    }
}



function get_sales_items_by_sale_id($sale_id)
{
    $sql = "SELECT si.*, p.Product_Name
            FROM sales_items si
            JOIN products p ON si.Sales_Product_id  = p.Product_id
            WHERE si.sale_id = $sale_id";

    $res = $this->db->query($sql);

    $sales_items = [];

    while ($row = $res->fetch_array()) {
        $item = new SalesItem();

        $item->Item_id = $row["sale_item_id"];
        $item->sale_id = $row["sale_id"];
        $item->product_id = $row["Sales_Product_id"];
        $item->Product_Name = $row["Product_Name"]; // Added product name
        $item->Item_Quantity = $row["quantity"];
        $item->Item_Price = $row["item_price"];
        $item->Item_Discount = $row["discount"];
        $item->Item_Amount = $row["item_amount"];
        // $item->Item_Status = $row["Item_Status"];
        // $item->Item_Timestamp = $row["Item_Timestamp"];

        $sales_items[] = $item;
    }

    return $sales_items;
}



}






?>