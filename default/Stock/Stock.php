<?php

include_once "../config.php";

class Stock
{
    public $product_id;
    public $quantity_in_stock;
    public $reorder_level;
    public $product_name;
    public $stock_status;
    public $added_date;

   
    private $db;

    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }


    function insert_stock()
    {
        $sql = "INSERT INTO stock (product_id, quantity_in_stock, reorder_level, product_name, stock_status, added_date)
                VALUES ('$this->product_id', '$this->quantity_in_stock', '$this->reorder_level', '$this->product_name', '$this->stock_status', NOW())";

        $this->db->query($sql);

        // echo $sql;

        return true;
    }

// --------------------------------------------------------


    function get_all_active_stock()
    {
        $sql = "SELECT * FROM `stock`
                WHERE `stock_status` = 'Active'";
        $res = $this->db->query($sql);

        $all_stock = [];

        while ($row = $res->fetch_array()) {
            $stock = new Stock();

            $stock->product_id = $row["product_id"];
            $stock->quantity_in_stock = $row["quantity_in_stock"];
            $stock->reorder_level = $row["reorder_level"];
            $stock->product_name = $row["product_name"];
            $stock->stock_status = $row["stock_status"];
            $stock->added_date = $row["added_date"];

            $all_stock[] = $stock;
        }

        return $all_stock;
    }


    function getProductsBelowReorderLevel() {
        $sql = "SELECT * FROM stock WHERE quantity_in_stock <= reorder_level AND stock_status ='Active'";
        $result = $this->db->query($sql);

        $productsBelowReorderLevel = [];

        while ($row = $result->fetch_object()) {
            $productsBelowReorderLevel[] = $row;
        }

        return $productsBelowReorderLevel;
    }


    function deleted_product($product_id)
    {
        $sql = "UPDATE stock SET stock_status='remover'
                WHERE product_id = $product_id";

        $this->db->query($sql);
    }
}

?>
