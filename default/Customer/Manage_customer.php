<?php
session_start();
include_once "../head.php";
include_once "customer.php";

$c = new customer;

if (isset($_GET["did"]))
{
	$customer_id=$_GET["did"];
	$c->delete_customer($customer_id);
}


$data = $c->get_all_active_customers();
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
                                                <h4>Manage Customer</h4>
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
                                                <h5> Customers</h5>
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

        foreach ($data as $customer) {
            echo "
                <tr>
                    <td>$customer->Customer_Name</td>
                    <td>$customer->Customer_Contact_Number</td>
                    <td>$customer->Customer_Email</td>
                    <td>$customer->Customer_Address</td>
                  
                    <td>
                    <a class='table_icons' href='Customer_Profile.php?c_id=$customer->Customer_id' title='View'><button class='table_btn btn btn-out btn-primary btn-square '><i class='tb_i fa-1x fa fa-eye'></i></button></a>

                        <a class='table_icons' href='Create_New_Customer.php?c_id=$customer->Customer_id' title='Edit'><button class='table_btn btn btn-out btn-success btn-square'><i class='tb_i fa-1x fa fa-edit'></i></button></a>
                        <button onclick='delete_customer($customer->Customer_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i>
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

    </div>



    <!-- ------------------------------------------------------------------------------------------- -->

    <?php
    include_once "../foot.php"
    ?>


<script>



function delete_customer(d) {
    if (confirm("Arw you sure you want to delete " + d)) {
        window.location.href = "Manage_customer.php?did=" + d;
    }
}

</script>