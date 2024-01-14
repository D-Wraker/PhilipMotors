<?php
include_once "../head.php";
include_once "Admin.php"; 
include_once "../Login/Login.php";

$login = new Login();

$admin = new Admin();

if (isset($_GET["did"])) {
    $admin_id = $_GET["did"];
    
    $admin->deleteAdmin($admin_id);
    $login->deleteLogin($admin_id);
}

$data = $admin->getAllActiveAdmins();
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
                                            <h4>Manage Admins</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- Additional header content if needed -->
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Admins</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="container">
                                                <div class="dt-responsive table-responsive">
                                                    <?php
                                                    echo "
                                                        <table id='basic-btn' class='table table-striped table-bordered nowrap'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th>Contact Number</th>
                                                                    <th>Email</th>
                                                                    <th>Address</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";

                                                    foreach ($data as $admin) {
                                                        echo "
                                                            <tr>
                                                                <td>$admin->Admin_Name</td>
                                                                <td>$admin->Admin_Contact_Number</td>
                                                                <td>$admin->Admin_Email</td>
                                                                <td>$admin->Admin_Address</td>
                                                                <td>
                                                                    <a class='table_icons' href='Admin_Profile.php?a_id=$admin->Admin_id' title='View'><button class='table_btn btn btn-out btn-primary btn-square '><i class='tb_i fa-1x fa fa-eye'></i></button></a>
                                                                    <a class='table_icons' href='Create_New_Admin.php?admin_id=$admin->Admin_id' title='Edit'><button class='table_btn btn btn-out btn-success btn-square'><i class='tb_i fa-1x fa fa-edit'></i></button></a>
                                                                    <button onclick='delete_admin($admin->Admin_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></i></button>
                                                                </td>
                                                            </tr>";
                                                    }

                                                    echo "</tbody></table>";

                                                    ?>
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

    </div>

    <!-- ------------------------------------------------------------------------------------------- -->

    <?php
    include_once "../foot.php"
    ?>

    <script>
        function delete_admin(d) {
            if (confirm("Are you sure you want to delete " + d)) {
                window.location.href = "Manage_Admin.php?did=" + d;
            }
        }
    </script>
