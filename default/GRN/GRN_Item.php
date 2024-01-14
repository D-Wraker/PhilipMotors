<?php

class GRN_Item
{
    public $grn_id;
    public $item_id;
    public $product_id;
    public $received_quantity;
    public $unit_price;
    public $discount;
    public $received_amount;
    public $item_status;
    public $item_timestamp;
    public $grn_item_id;
    public $Product_Name;

    private $db;

    function __construct()
    {
        $this->db = new mysqli(host, un, password, db); // create database connection
    }

    // function insert_grn_items($grn_id)
    // {
    //     // Debugging line to print the $_POST array
    //     // echo '<pre>';
    //     // print_r($_POST);
    //     // echo '</pre>';

    //     $grn_item_list = 0;

    //     // Check if item_id is set and is an array
    //     if (isset($_POST["Received_Product_id"]) && is_array($_POST["Received_Product_id"])) {
    //         foreach ($_POST["Received_Product_id"] as $grnItem) {
    //             $product_id = $_POST["Received_Product_id"][$grn_item_list];
    //             $received_quantity = $_POST["Received_Quantity"][$grn_item_list];
    //             $unit_price = $_POST["Unit_Price"][$grn_item_list];
    //             $received_amount = $_POST["Received_Amount"][$grn_item_list];

    //             $sql = "INSERT INTO grn_items (grn_id, product_id, received_quantity, unit_price, received_amount) 
    //                     VALUES ('$grn_id', '$product_id', '$received_quantity', '$unit_price', '$received_amount')";

    //             $this->db->query($sql);

    //             // Debugging line to print the SQL query
    //             echo $sql;

    //             $grn_item_list++;
    //         }

    //     } else {
    //         // Handle the case where item_id is not set or is not an array
    //         echo "No items to insert.";
    //     }

    //     return true;
    // }

    function insert_grn_items($grn_id)

{
    $grn_item_list = 0;

    // Check if item_id is set and is an array
    if (isset($_POST["Received_Product_id"]) && is_array($_POST["Received_Product_id"])) {
        foreach ($_POST["Received_Product_id"] as $grnItem) {
            $product_id = $_POST["Received_Product_id"][$grn_item_list];
            $received_quantity = $_POST["Received_Quantity"][$grn_item_list];
            $unit_price = $_POST["Unit_Price"][$grn_item_list];
            $received_amount = $_POST["Received_Amount"][$grn_item_list];

            // Insert into grn_items table
            $sql = "INSERT INTO grn_items (grn_id, product_id, received_quantity, unit_price, received_amount) 
                    VALUES ('$grn_id', '$product_id', '$received_quantity', '$unit_price', '$received_amount')";
            $this->db->query($sql);

            // Update stock table
            $this->update_stock($product_id, $received_quantity);

            // Debugging line to print the SQL query
            echo $sql;

            $grn_item_list++;
        }
    } else {
        // Handle the case where item_id is not set or is not an array
        echo "No items to insert.";
    }

    return true;
}

function update_stock($product_id, $received_quantity)
{
    // Check if the product exists in the stock table
    $existing_quantity = $this->get_stock_quantity($product_id);

    if ($existing_quantity !== false) {
        // Update the existing stock quantity
        $new_quantity = $existing_quantity + $received_quantity;
        $sql = "UPDATE stock SET quantity_in_stock = '$new_quantity' WHERE product_id = '$product_id'";
        $this->db->query($sql);
        // Debugging line to print the SQL query
        // echo $sql;
    } else {
        // Insert a new record in the stock table if the product doesn't exist
        $sql = "INSERT INTO stock (product_id, quantity_in_stock) VALUES ('$product_id', '$received_quantity')";
        $this->db->query($sql);
        // Debugging line to print the SQL query
        // echo $sql;
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



function get_grn_items_by_grn_id($grn_id)
    {
        $sql = "SELECT gi.*, p.Product_Name
                FROM grn_items gi
                JOIN products p ON gi.product_id = p.Product_id
                WHERE gi.grn_id = $grn_id";

        $res = $this->db->query($sql);

        $grn_items = [];

        while ($row = $res->fetch_array()) {
            $item = new GRN_Item();

            $item->grn_item_id = $row["grn_item_id"];
            $item->grn_id = $row["grn_id"];
            $item->product_id = $row["product_id"];
            $item->Product_Name = $row["Product_Name"]; // Added product name
            $item->received_quantity = $row["received_quantity"];
            $item->unit_price = $row["unit_price"];
            // $item->discount = $row["discount"];
            $item->received_amount = $row["received_amount"];
            $item->item_status = $row["item_status"];
            $item->item_timestamp = $row["item_timestamp"];

            $grn_items[] = $item;
        }

        return $grn_items;
    }

}
