<?php

include_once "Admin.php"; 
include_once "../Login/Login.php";

$a = new Admin;
$lg_Admin = new login();

if (isset($_GET["admin_id"])) {
    $a = $a->get_admin_by_id($_GET["admin_id"]);
}

if (isset($_POST["Admin_Name"])) {
    $a->Admin_Name = $_POST["Admin_Name"];
    $a->Admin_Contact_Number = $_POST["Admin_Contact_Number"];
    $a->Admin_Email = $_POST["Admin_Email"];
    $a->Admin_Address = $_POST["Admin_Address"];


    $lg_Admin->user_name = $_POST["Admin_Name"];
    $lg_Admin->user_email = $_POST["Admin_Email"];
    $lg_Admin->user_role = "2";
    $lg_Admin->user_password = $_POST["Admin_password"];

    if (isset($_POST["admin_id"])) {
        $a->update_admin($_POST["admin_id"]);
        header("Location:Create_New_Admin.php?e=yes");
    } else {
        $result = $a->insert_admin();
        $lg_Admin->insert_login( $result);
        header("Location:Create_New_Admin.php?s=yes");
    }
}


include_once "../head.php";
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
                                            <h4>Add Admin</h4>
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
                                            <h5>Admin</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Create_New_Admin.php">

                                                <?php
                                                if (isset($_GET["admin_id"])) {
                                                    echo "
    <input type='text' class='form-control' name='admin_id' id='admin_id' value='" . $_GET['admin_id'] . " '  placeholder='Enter admin id' hidden required>
";
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <label for="Admin_Name">Admin Name:</label>
                                                    <input type="text" class="form-control" name="Admin_Name" id="Admin_Name" value="<?= $a->Admin_Name ?>" placeholder="Enter admin name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Admin_Contact_Number">Contact Number:</label>
                                                    <input type="tel" class="form-control" name="Admin_Contact_Number" id="Admin_Contact_Number" value="<?= $a->Admin_Contact_Number ?>" placeholder="Enter contact number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Admin_Address">Address:</label>
                                                    <input type="text" class="form-control" name="Admin_Address" id="Admin_Address" value="<?= $a->Admin_Address ?>" placeholder="Enter address">
                                                </div>
                                                <div class="form-group">
                                                    <label for="Admin_Email">Email:</label>
                                                    <input type="email" class="form-control" name="Admin_Email" id="Admin_Email" value="<?= $a->Admin_Email ?>" placeholder="Enter email">
                                                </div>
                                                 <div class="form-group">
                                                    <label for="Admin_Email">Password:</label>
                                                    <input type="password" class="form-control" name="Admin_password" id="Admin_password"  placeholder="Enter Password">
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
        text: "Admin Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_Admin.php";
      });
    

    
    </script>';
}
?>