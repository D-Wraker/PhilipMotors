<?php
session_start();

include_once "customer.php";


$c = new customer;

if (isset($_GET["c_id"])) {
    $c = $c->get_customer_by_id($_GET["c_id"]);
}


if (isset($_POST["Customer_Name"])) {
    $c->Customer_Name = $_POST["Customer_Name"];
    $c->Customer_Contact_Number = $_POST["Customer_Contact_Number"];
    $c->Customer_Email = $_POST["Customer_Email"];
    $c->Customer_Address = $_POST["Customer_Address"];
  

    if (isset($_POST["c_id"])) {
        $c->update_customer($_POST["c_id"]);
        header("Location:Create_New_Customer.php?e=yes");
    } else {
        $result = $c->insert_customer();
      
        header("Location:Create_New_Customer.php?s=yes");
    }
}




if ($_SESSION["user"]["user_role"] == 2) {
    include_once "../head.php";
}  else {
    header("Location:../Login/logout.php");
}


// include_once "../head.php";
?>





<div class="pcoded-main-container">
    <div class="pcoded-wrapper">

        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <!-- Main-body start -->
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <div class="d-inline">
                                            <h4> <?php
                                                    if (isset($_GET["c_id"])) {
                                                        echo "Edit Customer";
                                                    } else
                                                        echo "Add New Customer"

                                                    ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">

                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Customer Form</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Create_New_Customer.php">

                                            <?php
                                                            if (isset($_GET["c_id"])) {
                                                                echo "
                                                        <input type='text' class='form-control' name='c_id' id='c_id'  value='" . $_GET['c_id'] . " '  placeholder='Enter  first name' hidden required>
";
                                                            }
                                                            ?>

                                                <div class="form-group">
                                                    <label for="CustomerName">Customer Name:</label>
                                                    <input type="text" class="form-control" name="Customer_Name" id="Customer_Name" value="<?= $c->Customer_Name ?>" placeholder="Enter customer name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ContactNumber">Contact Number:</label>
                                                    <input type="tel" class="form-control" name="Customer_Contact_Number" id="Customer_Contact_Number" value="<?= $c->Customer_Contact_Number ?>" placeholder="Enter contact number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Email">Email:</label>
                                                    <input type="email" class="form-control" name="Customer_Email" id="Customer_Email" value="<?= $c->Customer_Email ?>" placeholder="Enter email " required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Address">Address:</label>
                                                    <input type="text" class="form-control" name="Customer_Address" id="Customer_Address" value="<?= $c->Customer_Address ?>" placeholder="Enter address">
                                                </div>


                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>



<!-- ------------------------------------------------------------------------------------------- -->

<?php
include_once "../foot.php";

if (isset($_GET['s'])) {


    echo '<script>
    swal({
        title: "Success!",
        text: "Customer Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_customer.php";
      });
    

    
    </script>';
}


if (isset($_GET['e'])) {


    echo '<script>
    swal({
        title: "Success!",
        text: "Customer Details Successfully Edited",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_customer.php";
      });
    

    
    </script>';
}
?>