<?php
include_once "../config.php"; 

class login
{

public $login_id;
public $user_name;
public $user_email;
public $user_role;
public $user_id;
public $user_password;
public $statusreg_time;

private $db;


function __construct()
{

    $this->db = new mysqli(host, un, password, db); // create database connection 
}




function insert_login($user_id){

  $sql="INSERT INTO login (user_name, user_email, user_role, user_id, user_password)
    VALUES ('$this->user_name ', '$this->user_email', '$this->user_role', $user_id, md5('$this->user_password'))";

    $this->db->query($sql);

    // echo $sql;
    return true;

}



function check_login($un,$pw){
    $query="SELECT * FROM login WHERE user_email='$un' AND  user_password=md5('$pw') AND login_status = 'Active'";
    // echo $query;
    $result = $this->db->query($query);
    // echo $result;
    if($row=$result->fetch_array())
    {
        session_start();
        $_SESSION["user"]=$row;
        
        return true;
            
    }
    else{
        return false;     
  

    
    }

}

// -------------------------------------------------------------------

function change_member_password($urole,$u_id){


    $sql="UPDATE `login` SET `user_password`=md5('$this->user_password') WHERE `user_role` ='$urole' AND `user_id`='$u_id'";
    $this->db->query($sql);
    // echo $sql;
}


function deleteLogin($user_id)
{
    $sql = "UPDATE login SET login_status ='deleted'
            WHERE user_id = $user_id";

    $this->db->query($sql);

   
}


}



?>