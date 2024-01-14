<?php
include_once "../config.php";

class Purchase
{
    public $Purchase_id;
    public $Supplier_id;
    public $purchase_balance;
    public $purchase_paid_amount;
    public $Purchase_Date;
    public $bill_total;
    public $Purchase_Timestamp;
    public $purchase_status;

    public $Supplier_Name;

    private $db;
    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }



    function insert_purchase()
    {
        $sql = "INSERT INTO purchases (Supplier_id, purchase_balance, purchase_paid_amount, Purchase_Date, bill_total )
            VALUES ('$this->Supplier_id', '$this->purchase_balance', '$this->purchase_paid_amount', '$this->Purchase_Date', '$this->bill_total')";

        $this->db->query($sql);
        $purchase_id = $this->db->insert_id;

        // echo $sql;

        return $purchase_id;
    }





function get_all_active_purchases()
{
    $sql = "SELECT p.*, s.Supplier_Name
            FROM purchases p
            JOIN supplier s ON p.Supplier_id = s.Supplier_id
            WHERE p.purchase_status = 'Active'";
            
    $res = $this->db->query($sql);

    $all_purchases = [];

    while ($row = $res->fetch_array()) {
        $p = new Purchase();

        $p->Purchase_id = $row["Purchase_id"];
        $p->Supplier_id = $row["Supplier_id"];
        $p->Supplier_Name = $row["Supplier_Name"];  // Added supplier name
        $p->purchase_balance = $row["purchase_balance"];
        $p->purchase_paid_amount = $row["purchase_paid_amount"];
        $p->Purchase_Date = $row["Purchase_Date"];
        $p->bill_total = $row["bill_total"];
        $p->purchase_status = $row["purchase_status"];

        $all_purchases[] = $p;
    }
    return $all_purchases;
}


function get_purchase_by_id($purchase_id)
{
    $sql = "SELECT p.*, s.Supplier_Name
            FROM purchases p
            JOIN supplier s ON p.Supplier_id = s.Supplier_id
            WHERE p.Purchase_id = $purchase_id";

    $res = $this->db->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_array();

        $p = new Purchase();

        $p->Purchase_id = $row["Purchase_id"];
        $p->Supplier_id = $row["Supplier_id"];
        $p->Supplier_Name = $row["Supplier_Name"];  // Added supplier name
        $p->purchase_balance = $row["purchase_balance"];
        $p->purchase_paid_amount = $row["purchase_paid_amount"];
        $p->Purchase_Date = $row["Purchase_Date"];
        $p->bill_total = $row["bill_total"];
        $p->purchase_status = $row["purchase_status"];

        return $p;
    }

    // Return null or handle the case when the purchase with the given ID is not found
    return null;
}

function get_purchases_by_supplier_id($supplier_id)
{
    $sql = "SELECT p.*, s.Supplier_Name
            FROM purchases p
            JOIN supplier s ON p.Supplier_id = s.Supplier_id
            WHERE p.Supplier_id = $supplier_id";

    $res = $this->db->query($sql);

    $all_purchases = [];

    while ($row = $res->fetch_array()) {
        $p = new Purchase();

        $p->Purchase_id = $row["Purchase_id"];
        $p->Supplier_id = $row["Supplier_id"];
        $p->Supplier_Name = $row["Supplier_Name"];  // Added supplier name
        $p->purchase_balance = $row["purchase_balance"];
        $p->purchase_paid_amount = $row["purchase_paid_amount"];
        $p->Purchase_Date = $row["Purchase_Date"];
        $p->bill_total = $row["bill_total"];
        $p->purchase_status = $row["purchase_status"];

        $all_purchases[] = $p;
    }

    return $all_purchases;
}

// ------------------------------------------


function updatePurchaseBalance($purchase_id, $new_balance)
{
    $sql_update_balance = "UPDATE purchases SET purchase_balance = '$new_balance' WHERE Purchase_id = '$purchase_id'";
    $this->db->query($sql_update_balance);
}

function getTotalPurchases($startDate = null, $endDate = null)
{
    $sql = "SELECT SUM(bill_total) AS total_purchases FROM purchases WHERE purchase_status = 'Active' ";

    // If start date and end date are provided, include them in the query
    if ($startDate && $endDate) {
        $sql .= " WHERE Purchase_Date BETWEEN '$startDate' AND '$endDate'";
    }

    $res = $this->db->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_array();
        return $row["total_purchases"];
    }

    // Return 0 if there are no purchases or an error occurs
    return 0;
}




function getProductsPurchasedInPurchase($purchaseId)
{
    $sql = "SELECT `product_id`, `quantity` FROM purchase_items WHERE purchase_id = '$purchaseId'";
    $result = $this->db->query($sql);

    $productsPurchased = [];

    while ($row = $result->fetch_object()) {
        $productsPurchased[] = $row;
    }

    return $productsPurchased;
}

function revertPurchaseStock($purchaseId)
{
    // Retrieve products and quantities purchased in the specified purchase
    $productsPurchased = $this->getProductsPurchasedInPurchase($purchaseId);

    // Update the stock by subtracting the quantities
    foreach ($productsPurchased as $product) {
        $this->subtractStock($product->product_id, $product->quantity);
    }
}

function subtractStock($productId, $quantity)
{
    $sql = "UPDATE stock SET quantity_in_stock = quantity_in_stock - $quantity WHERE product_id = '$productId'";
    $this->db->query($sql);
}



function delete_purchase($purchase_id)
{
    $sql = "UPDATE purchases SET purchase_status='deleted'
            WHERE purchase_id = $purchase_id";

    $this->db->query($sql);
}


}
