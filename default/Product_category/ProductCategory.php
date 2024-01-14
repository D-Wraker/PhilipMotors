<?php

include_once "../config.php";

class ProductCategory
{
    public $Category_id;
    public $Category_Name;
    public $Category_Description;

    public $Category_Status;
    public $Category_Timestamp;


    private $db;

    function __construct()
    {

        $this->db = new mysqli(host, un, password, db);
    }

    //-----------------------------------------------------------

    function insert_product_category()
    {
        $sql = "INSERT INTO product_category  (Category_Name, Category_Description)
                VALUES ('$this->Category_Name', '$this->Category_Description')";
        
        $this->db->query($sql);
        $category_id = $this->db->insert_id;
    
        // echo $sql;
    
        return $category_id;
    }


    //--------------------------------------------------------------------

    function get_all_active_product_categories()
{
    $sql = "SELECT * FROM `product_category`
            WHERE `Category_Status` = 'Active'";
    $res = $this->db->query($sql);

    $all_categories = [];

    while ($row = $res->fetch_array()) {
        $category = new ProductCategory();

        $category->Category_id = $row["Category_id"];
        $category->Category_Name = $row["Category_Name"];
        $category->Category_Description = $row["Category_Description"];
        $category->Category_Status = $row["Category_Status"];
        $category->Category_Timestamp = $row["Category_Timestamp"];

        $all_categories[] = $category;
    }

    return $all_categories;
}

//-------------------------------------------------------------------------


// function delete_category($category_id)
// {
//     $sql = "UPDATE product_category SET Category_Status='deleted'
//             WHERE Category_id = $category_id";

//     $this->db->query($sql);
// }


// function delete_category($category_id)
// {
//     // Check if there are products related to this category
//     $checkProductsSql = "SELECT COUNT(*) AS product_count FROM products WHERE Product_Category = $category_id";
//     $productCountResult = $this->db->query($checkProductsSql);
//     $productCount = $productCountResult->fetch_assoc()['product_count'];

//     if ($productCount > 0) {
//         // If there are products, do not delete the category
//         return "Cannot delete category. There are products related to this category.";
//     } else {
//         // If no products are related, proceed with the deletion
//         $deleteCategorySql = "UPDATE product_category SET Category_Status='deleted' WHERE Category_id = $category_id";
//         $this->db->query($deleteCategorySql);

//         return "Category deleted successfully.";
//     }
// }


function delete_category($category_id)
{
    // Check if there are products related to this category
    $checkProductsSql = "SELECT COUNT(*) AS product_count FROM products WHERE Product_Category = $category_id";
    $productCountResult = $this->db->query($checkProductsSql);
    $productCount = $productCountResult->fetch_assoc()['product_count'];

    if ($productCount > 0) {
        // If there are products, output a JavaScript script with an alert
        $alertMessage = "Cannot delete category. There are products related to this category.";
    } else {
        // If no products are related, proceed with the deletion
        $deleteCategorySql = "UPDATE product_category SET Category_Status='deleted' WHERE Category_id = $category_id";
        $this->db->query($deleteCategorySql);

        // Set the success message
        $alertMessage = "Category deleted successfully.";
    }

    // Output the JavaScript script to trigger the alert
    echo "<script>";
    echo "alert('$alertMessage');";
    echo "window.location.href = 'Manage_Product_category.php';";
    echo "</script>";
}


//---------------------------------------------------------------------------


function update_category($category_id)
{
    $sql = "UPDATE product_category
            SET Category_Name = '$this->Category_Name',
                Category_Description = '$this->Category_Description'
            WHERE Category_id = '$category_id'";

    $this->db->query($sql);

    // echo $sql;
}


public function get_category_by_id($category_id)
    {
        $sql = "SELECT * FROM `product_category` WHERE `Category_id` = '$category_id'";
        $res = $this->db->query($sql);

        $row = $res->fetch_array();

        // echo $sql;

        $this->Category_id = $row["Category_id"];
        $this->Category_Name = $row["Category_Name"];
        $this->Category_Description = $row["Category_Description"];
        $this->Category_Status = $row["Category_Status"];

        return $this;
    }
    

}


?>