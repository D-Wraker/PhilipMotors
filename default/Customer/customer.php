<?php
include_once "../config.php";
class customer
{


    public $Customer_id;
    public $Customer_Name;
    public $Customer_Contact_Number;
    public $Customer_Email;
    public $Customer_Address;
    public $Customer_Status;
    public $Customer_RegDate;


    private $db;

    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }

    function insert_customer()
    {
        $sql = "INSERT INTO customer (Customer_Name, Customer_Contact_Number, Customer_Email, Customer_Address)
                VALUES ('$this->Customer_Name', '$this->Customer_Contact_Number', '$this->Customer_Email', '$this->Customer_Address')";
    
        $this->db->query($sql);
        $customer_id = $this->db->insert_id;
    
        // echo $sql;
    
        return $customer_id;
    }

//----------------------------------------------------------------------------------------
    function get_all_active_customers()
    {
        $sql = "SELECT * FROM `customer`
                WHERE `Customer_Status` = 'Active'";
        $res = $this->db->query($sql);
    
        $all_customers = [];
    
        while ($row = $res->fetch_array()) {
            $c = new Customer();
    
            $c->Customer_id = $row["Customer_id"];
            $c->Customer_Name = $row["Customer_Name"];
            $c->Customer_Contact_Number = $row["Customer_Contact_Number"];
            $c->Customer_Email = $row["Customer_Email"];
            $c->Customer_Address = $row["Customer_Address"];
            $c->Customer_Status = $row["Customer_Status"];
            $c->Customer_RegDate = $row["Customer_RegDate"];
    
            $all_customers[] = $c;
        }
        return $all_customers;
    }
    

    //--------------------------------------------------------------------------------

    function update_customer($customer_id)
{
    $sql = "UPDATE customer
            SET Customer_Name = '$this->Customer_Name',
                Customer_Contact_Number = '$this->Customer_Contact_Number',
                Customer_Email = '$this->Customer_Email',
                Customer_Address = '$this->Customer_Address'
            WHERE Customer_id = '$customer_id'";

    $this->db->query($sql);

    // echo $sql;
}

//--------------------------------------------------------------------------------------------

function get_customer_by_id($customer_id)
{
    $sql = "SELECT * FROM `customer` WHERE `Customer_id` = '$customer_id'";
    $res = $this->db->query($sql);
    $row = $res->fetch_array();

    // echo $sql;

    $this->Customer_id = $row["Customer_id"];
    $this->Customer_Name = $row["Customer_Name"];
    $this->Customer_Contact_Number = $row["Customer_Contact_Number"];
    $this->Customer_Email = $row["Customer_Email"];
    $this->Customer_Address = $row["Customer_Address"];
    $this->Customer_Status = $row["Customer_Status"];
    $this->Customer_RegDate = $row["Customer_RegDate"];

    return $this;
}

//--------------------------------------------------

function delete_customer($customer_id)
{
    $sql = "UPDATE customer SET Customer_Status='deleted'
            WHERE Customer_id = $customer_id";

    $this->db->query($sql);
}




    
}


?>