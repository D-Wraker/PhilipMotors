<?php
include_once "../config.php";

class GRN {

    public $grn_Id;
    public $grn_supplierId;
    public $grn_receiptDate;
    public $grn_bill_total;
    public $grn_added_date;
    public $grn_status;

    public $supplier_name;


    private $db;

    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }


    function insert_grn()
{
    $sql = "INSERT INTO grn (grn_supplierId, grn_bill_total, grn_added_date)
            VALUES ('$this->grn_supplierId', '$this->grn_bill_total', '$this->grn_receiptDate')";
    
    $this->db->query($sql);
    $grn_Id = $this->db->insert_id;

    echo $sql;

    return $grn_Id;
}

function get_all_active_grn()
{
    $sql = "SELECT g.*, s.Supplier_Name
            FROM `grn` g
            JOIN `supplier` s ON g.grn_supplierId = s.Supplier_id
            WHERE g.`grn_status` = 'Active'";
    
    $res = $this->db->query($sql);

    $all_grn = [];

    while ($row = $res->fetch_array()) {
        $grn = new GRN();

        $grn->grn_Id = $row["grn_Id"];
        $grn->grn_supplierId = $row["grn_supplierId"];
        $grn->grn_receiptDate = $row["grn_receiptDate"];
        $grn->grn_bill_total = $row["grn_bill_total"];
        $grn->grn_added_date = $row["grn_added_date"];
        $grn->grn_status = $row["grn_status"];
        $grn->supplier_name = $row["Supplier_Name"]; // Added supplier name

        $all_grn[] = $grn;
    }

    return $all_grn;
}


function delete_grn($grn_Id)
{
    $sql = "UPDATE grn SET grn_status='deleted'
            WHERE grn_Id = $grn_Id";

    $this->db->query($sql);
}


function get_grn_by_id($grn_id)
{
    $sql = "SELECT g.*, s.supplier_name
            FROM grn g
            JOIN supplier s ON g.grn_supplierId = s.Supplier_id
            WHERE g.grn_Id = $grn_id";

    $res = $this->db->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_array();

        $grn = new GRN();

        $grn->grn_Id = $row["grn_Id"];
        $grn->grn_supplierId = $row["grn_supplierId"];
        $grn->supplier_name = $row["supplier_name"]; 
        // $grn->grn_balance = $row["grn_balance"];
        // $grn->grn_paid_amount = $row["grn_paid_amount"];
        $grn->grn_receiptDate = $row["grn_receiptDate"];
        $grn->grn_bill_total = $row["grn_bill_total"];
        $grn->grn_added_date = $row["grn_added_date"];
        $grn->grn_status = $row["grn_status"];

        return $grn;
    }

    // Return null or handle the case when the GRN with the given ID is not found
    return null;
}



public function deleteGRN($grnId) {
    // Delete the GRN from the grn table
    $sqlDeleteGRN = "DELETE FROM grn WHERE grn_id = '$grnId'";
    $this->db->query($sqlDeleteGRN);

    // Revert stock for the products in the GRN
    $this->revertGRNStock($grnId);
}

// Function to revert stock for a specific GRN
private function revertGRNStock($grnId) {
    // Retrieve products and quantities received in the specified GRN
    $productsReceived = $this->getProductsReceivedInGRN($grnId);

    // Update the stock by subtracting the received quantities
    foreach ($productsReceived as $product) {
        $this->subtractStock($product->product_id, $product->received_quantity);
    }
}

// Function to get products and quantities received in a specific GRN
private function getProductsReceivedInGRN($grnId) {
    $sql = "SELECT product_id, received_quantity FROM grn_items WHERE grn_id = '$grnId'";
    $result = $this->db->query($sql);

    $productsReceived = [];

    while ($row = $result->fetch_object()) {
        $productsReceived[] = $row;
    }

    return $productsReceived;
}

// Function to subtract stock for a specific product
private function subtractStock($productId, $quantity) {
    // Your logic to update the stock for the given product
    // For example, you might have a products table with a quantity_in_stock column
    // You would decrement the quantity_in_stock for the specified product by $quantity
    $sql = "UPDATE stock SET quantity_in_stock = quantity_in_stock - $quantity WHERE product_id = '$productId'";
    $this->db->query($sql);
}


}