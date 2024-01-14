<?php

include_once "../config.php";

class Product
{
    public $Product_id;
    public $Product_Name;
    public $Product_Description;
    public $Product_Model;
    public $Product_Price;
    public $Product_QuantityInStock;
    public $Product_reorder_level;
    public $Product_Supplier;
    public $Product_Category;
    public $ProductStatus;
    public $Product_Timestamp;

    public $Product_Category_name;
    public $Supplier_Name;

    private $db;

    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }


    function insert_product()
    {
        // Insert into products table
        $sqlProducts = "INSERT INTO products (Product_Name, Product_Description, Product_Model, Product_Price, Product_QuantityInStock, Product_reorder_level, Product_Supplier, Product_Category)
                        VALUES ('$this->Product_Name', '$this->Product_Description', '$this->Product_Model', '$this->Product_Price', '$this->Product_QuantityInStock','$this->Product_reorder_level', '$this->Product_Supplier', '$this->Product_Category')";

        $this->db->query($sqlProducts);
        $product_id = $this->db->insert_id;
        // echo $sqlProducts;
        // Check if the product was successfully inserted
        if ($product_id) {
            // Insert into stock table
            $sqlStock = "INSERT INTO stock (product_id, quantity_in_stock, reorder_level, product_name, stock_status, added_date)
                         VALUES ('$product_id', '$this->Product_QuantityInStock', '$this->Product_reorder_level', '$this->Product_Name', 'Active', NOW())";

            $this->db->query($sqlStock);

            // Check if the stock record was successfully inserted
            if ($this->db->affected_rows > 0) {
                // Return the product_id
                return $product_id;
            } else {
                // Handle the case where the stock record insertion failed
                // You may want to roll back the product insertion as well
                echo "Failed to add stock record.";
                // Rollback product insertion (optional)
                $this->db->query("DELETE FROM products WHERE product_id = '$product_id'");
                return false;
            }
        } else {
            // Handle the case where the product insertion failed
            echo "Failed to add product.";
            return false;
        }
    }

    // -----------------------------------------------------------------------------
    public function update_product($product_id)
    {
        $sql = "UPDATE products
                SET Product_Name = '$this->Product_Name',
                    Product_Description = '$this->Product_Description',
                    Product_Model = '$this->Product_Model',
                    Product_Price = '$this->Product_Price',
                    Product_QuantityInStock = '$this->Product_QuantityInStock',
                    Product_Supplier = '$this->Product_Supplier',
                    Product_Category = '$this->Product_Category',
                    Product_reorder_level ='$this->Product_reorder_level'
                WHERE Product_id = '$product_id'";

        $this->db->query($sql);

        // echo $sql;
    }



    function get_all_active_products()
    {
        $sql = "SELECT p.*, c.Category_Name, s.Supplier_Name 
                FROM products p
                JOIN product_category c ON p.Product_Category = c.Category_id
                JOIN supplier s ON p.Product_Supplier = s.Supplier_id
                WHERE p.ProductStatus = 'Active'";

        $res = $this->db->query($sql);

        $all_products = [];

        while ($row = $res->fetch_array()) {
            $p = new Product();

            $p->Product_id = $row["Product_id"];
            $p->Product_Name = $row["Product_Name"];
            $p->Product_Description = $row["Product_Description"];
            $p->Product_Model = $row["Product_Model"];
            $p->Product_Price = $row["Product_Price"];
            $p->Product_QuantityInStock = $row["Product_QuantityInStock"];
            $p->Product_Supplier = $row["Product_Supplier"];
            $p->Product_Category = $row["Product_Category"];
            $p->Product_Category_name = $row["Category_Name"];
            $p->Supplier_Name = $row["Supplier_Name"];  // Added supplier name
            $p->Product_Timestamp = $row["Product_Timestamp"];

            $all_products[] = $p;
        }
        return $all_products;
    }




    function delete_product($product_id)
    {
        $sql = "UPDATE products SET ProductStatus='deleted'
                WHERE Product_id = $product_id";

        $this->db->query($sql);
    }


    public function get_product_by_id($product_id)
    {
        $sql = "SELECT * FROM `products` WHERE `Product_id` = '$product_id'";
        $res = $this->db->query($sql);
        $row = $res->fetch_array();

        // echo $sql;

        $this->Product_id = $row["Product_id"];
        $this->Product_Name = $row["Product_Name"];

        $this->Product_Description = $row["Product_Description"];
        $this->Product_Model = $row["Product_Model"];
        $this->Product_Price = $row["Product_Price"];
        $this->Product_reorder_level = $row["Product_reorder_level"];
        $this->Product_QuantityInStock = $row["Product_QuantityInStock"];
        $this->Product_Supplier = $row["Product_Supplier"];
        $this->Product_Category = $row["Product_Category"];
        $this->ProductStatus = $row["ProductStatus"];
        $this->Product_Timestamp = $row["Product_Timestamp"];

        return $this;
    }

    public function get_products_by_supplier_id($supplier_id)
    {
        $sql = "SELECT * FROM `products` WHERE `Product_Supplier` = '$supplier_id'";
        $result = $this->db->query($sql);

        $products = [];

        while ($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->Product_id = $row["Product_id"];
            $product->Product_Name = $row["Product_Name"];
            $product->Product_Description = $row["Product_Description"];
            $product->Product_Model = $row["Product_Model"];
            $product->Product_Price = $row["Product_Price"];
            $product->Product_QuantityInStock = $row["Product_QuantityInStock"];
            $product->Product_Supplier = $row["Product_Supplier"];
            $product->Product_Category = $row["Product_Category"];
            $product->ProductStatus = $row["ProductStatus"];
            $product->Product_Timestamp = $row["Product_Timestamp"];

            $products[] = $product;
        }

        return $products;
    }
}
