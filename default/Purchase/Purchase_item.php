<?php

class PurchaseItem
{
    public $purchase_id;
    public $product_id;
    public $Item_Quantity;
    public $Item_price;
    public $Item_Discount;
    public $Item_Amount;
    public $Item_Status;
    public $Item_Timestamp;
    public $Product_Name;

    public $purchase_item_id;

    private $db;
    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }


    function insert_purchase_items($purchase_id)
{
    $purchase_item_list = 0;

    // Check if Item_id is set and is an array
    if (isset($_POST["Item_id"]) && is_array($_POST["Item_id"])) {
        foreach ($_POST["Item_id"] as $purchaseItem) {
            $product_id = $_POST["Item_id"][$purchase_item_list];
            $quantity = $_POST["Item_Quantity"][$purchase_item_list];
            $item_price = $_POST["Item_Price"][$purchase_item_list];
            $discount = $_POST["Item_Discount"][$purchase_item_list];
            $item_amount = $_POST["Item_Amount"][$purchase_item_list];

            // Insert into purchase_items table
            $sql = "INSERT INTO purchase_items (purchase_id, product_id, quantity, item_price, discount, item_amount) 
                    VALUES ('$purchase_id', '$product_id', '$quantity', '$item_price', '$discount', '$item_amount')";
            $this->db->query($sql);

            // Update stock table
            // $this->update_stock($product_id, $quantity);

            // Debugging line to print the SQL query
            // echo $sql;

            $purchase_item_list++;
        }
    } else {
        // Handle the case where Item_id is not set or is not an array
        echo "No items to insert.";
    }

    return true;
}


//------------------------------------------

function get_purchase_items_by_purchase_id($purchase_id)
{
    $sql = "SELECT pi.*, p.Product_Name
            FROM purchase_items pi
            JOIN products p ON pi.product_id = p.Product_id
            WHERE pi.purchase_id = $purchase_id";

    $res = $this->db->query($sql);

    $purchase_items = [];

    while ($row = $res->fetch_array()) {
        $item = new PurchaseItem();

        $item->purchase_item_id = $row["purchase_item_id"];
        $item->purchase_id = $row["purchase_id"];
        $item->product_id = $row["product_id"];
        $item->Product_Name = $row["Product_Name"]; // Added product name
        $item->Item_Quantity = $row["quantity"];
        $item->Item_price = $row["item_price"];
        $item->Item_Discount = $row["discount"];
        $item->Item_Amount = $row["item_amount"];
        // $item->Item_Status = $row["Item_Status"];
        // $item->Item_Timestamp = $row["Item_Timestamp"];

        $purchase_items[] = $item;
    }

    return $purchase_items;
}




}


?>