<?php
include_once "../config.php";

class Supplier
{
    public $Supplier_id;
    public $Supplier_name;
    public $Supplier_contact_person;
    public $Supplier_contact_person_phoneNO;
    public $Supplier_Address;
    public $Supplier_status;
    public $Supplier_RegDate;


    private $db;

    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); 
    }


    function insert_supplier()
{
    $sql = "INSERT INTO supplier (Supplier_name, Supplier_contact_person, Supplier_contact_person_phoneNO,Supplier_Address)
            VALUES ('$this->Supplier_name', '$this->Supplier_contact_person', '$this->Supplier_contact_person_phoneNO', '$this->Supplier_Address')";
    
    $this->db->query($sql);
    $supplier_id = $this->db->insert_id;

    echo $sql;

    return $supplier_id;
}

// -----------------------------------------------------------------------------

function get_supplier_by_id($supplier_id)
{
    $sql = "SELECT * FROM `supplier` WHERE `Supplier_id` = '$supplier_id'";
    $res = $this->db->query($sql);
    $row = $res->fetch_array();

    // echo $sql;

    $this->Supplier_id = $row["Supplier_id"];
    $this->Supplier_name = $row["Supplier_name"];
    $this->Supplier_contact_person = $row["Supplier_contact_person"];
    $this->Supplier_contact_person_phoneNO = $row["Supplier_contact_person_phoneNO"];
    $this->Supplier_status = $row["Supplier_status"];
    $this->Supplier_RegDate = $row["Supplier_RegDate"];

    return $this;
}


function get_all_active_suppliers()
{
    $sql = "SELECT * FROM `supplier`
            WHERE `Supplier_status` = 'Active'";
    $res = $this->db->query($sql);

    $all_suppliers = [];

    while ($row = $res->fetch_array()) {
        $s = new Supplier();

        $s->Supplier_id = $row["Supplier_id"];
        $s->Supplier_name = $row["Supplier_name"];
        $s->Supplier_contact_person = $row["Supplier_contact_person"];
        $s->Supplier_contact_person_phoneNO = $row["Supplier_contact_person_phoneNO"];
        $s->Supplier_status = $row["Supplier_status"];
        $s->Supplier_RegDate = $row["Supplier_RegDate"];

        $all_suppliers[] = $s;
    }
    return $all_suppliers;
}


// -------------------------------------------------------------------------------
function update_supplier($supplier_id)
{
    $sql = "UPDATE supplier
            SET Supplier_name = '$this->Supplier_name',
                Supplier_contact_person = '$this->Supplier_contact_person',
                Supplier_contact_person_phoneNO = '$this->Supplier_contact_person_phoneNO',
               
            WHERE Supplier_id = '$supplier_id'";

    $this->db->query($sql);

    // echo $sql;
}


function delete_supplier($supplier_id)
{
    $sql = "UPDATE supplier SET Supplier_Status='deleted'
            WHERE Supplier_id = $supplier_id";

    $this->db->query($sql);
}





}


?>