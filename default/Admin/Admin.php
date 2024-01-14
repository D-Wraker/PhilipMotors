<?php
include_once "../config.php";

class Admin
{
    public $Admin_id;
    public $Admin_Name;
    public $Admin_Contact_Number;
    public $Admin_Email;
    public $Admin_Address;
    public $Admin_Status;
    public $Admin_RegDate;

    private $db;

    function __construct()
    {
        $this->db = new mysqli(host, un, password, db); // create database connection 
    }

    function insert_admin()
    {
        $sql = "INSERT INTO admin (Admin_Name, Admin_Contact_Number, Admin_Email, Admin_Address)
                VALUES ('$this->Admin_Name', '$this->Admin_Contact_Number', '$this->Admin_Email', '$this->Admin_Address')";
    
        $this->db->query($sql);
        $admin_id = $this->db->insert_id;
    
        return $admin_id;
    }

    function get_all_active_admins()
    {
        $sql = "SELECT * FROM `admin`
                WHERE `Admin_Status` = 'Active'";
        $res = $this->db->query($sql);
    
        $all_admins = [];
    
        while ($row = $res->fetch_array()) {
            $a = new Admin();
    
            $a->Admin_id = $row["Admin_id"];
            $a->Admin_Name = $row["Admin_Name"];
            $a->Admin_Contact_Number = $row["Admin_Contact_Number"];
            $a->Admin_Email = $row["Admin_Email"];
            $a->Admin_Address = $row["Admin_Address"];
            $a->Admin_Status = $row["Admin_Status"];
            $a->Admin_RegDate = $row["Admin_RegDate"];
    
            $all_admins[] = $a;
        }
        return $all_admins;
    }

    function update_admin($admin_id)
    {
        $sql = "UPDATE admin
                SET Admin_Name = '$this->Admin_Name',
                    Admin_Contact_Number = '$this->Admin_Contact_Number',
                    Admin_Email = '$this->Admin_Email',
                    Admin_Address = '$this->Admin_Address'
                WHERE Admin_id = '$admin_id'";
    
        $this->db->query($sql);
    }

    function get_admin_by_id($admin_id)
    {
        $sql = "SELECT * FROM `admin` WHERE `Admin_id` = '$admin_id'";
        $res = $this->db->query($sql);
        $row = $res->fetch_array();

        $this->Admin_id = $row["Admin_id"];
        $this->Admin_Name = $row["Admin_Name"];
        $this->Admin_Contact_Number = $row["Admin_Contact_Number"];
        $this->Admin_Email = $row["Admin_Email"];
        $this->Admin_Address = $row["Admin_Address"];
        $this->Admin_Status = $row["Admin_Status"];
        $this->Admin_RegDate = $row["Admin_RegDate"];

        return $this;
    }

    // function delete_admin($admin_id)
    // {
    //     $sql = "UPDATE admin SET Admin_Status='deleted'
    //             WHERE Admin_id = $admin_id";

    //     $this->db->query($sql);
    // }



    function deleteAdmin($admin_id)
    {
        $sql = "UPDATE admin SET Admin_Status='deleted'
                WHERE Admin_id = $admin_id";

        $this->db->query($sql);

       
    }



    function getAllActiveAdmins()
    {
        $sql = "SELECT * FROM `admin`
                WHERE `Admin_Status` = 'Active'";
        $res = $this->db->query($sql);

        $all_admins = [];

        while ($row = $res->fetch_array()) {
            $admin = new Admin();

            $admin->Admin_id = $row["Admin_id"];
            $admin->Admin_Name = $row["Admin_Name"];
            $admin->Admin_Contact_Number = $row["Admin_Contact_Number"];
            $admin->Admin_Email = $row["Admin_Email"];
            $admin->Admin_Address = $row["Admin_Address"];
            $admin->Admin_Status = $row["Admin_Status"];
            $admin->Admin_RegDate = $row["Admin_RegDate"];

            $all_admins[] = $admin;
        }

        return $all_admins;
    }



}
?>
