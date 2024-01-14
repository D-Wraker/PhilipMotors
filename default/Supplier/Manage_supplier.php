<?php
include_once "../head.php";
include_once "Supplier.php";

$s = new Supplier;

if (isset($_GET["did"]))
{
	$supplier_id=$_GET["did"];
	$s->delete_supplier($supplier_id);
}


$data = $s->get_all_active_suppliers();
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
                                                <h4>Manage Supplier</h4>
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
                                                <h5> Supplier</h5>
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
                    <th>Contact Person</th>
                    <th>Contact Person Phone Number</th>
                    <th>Status</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($data as $supplier) {
        echo "
            <tr>
                <td>$supplier->Supplier_name</td>
                <td>$supplier->Supplier_contact_person</td>
                <td>$supplier->Supplier_contact_person_phoneNO</td>
                <td>$supplier->Supplier_status</td>
           
                <td>
                    <a class='table_icons' href='supplier_profile.php?s_id=$supplier->Supplier_id' title='View'><button class='table_btn btn btn-out btn-primary btn-square'><i class='tb_i fa-1x fa fa-eye'></i></button></a>
                    <a class='table_icons' href='Create_New_Supplier.php?s_id=$supplier->Supplier_id' title='Edit'><button class='table_btn btn btn-out btn-success btn-square'><i class='tb_i fa-1x fa fa-edit'></i></button></a>
                    <button onclick='delete_supplier($supplier->Supplier_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i> 
                </td>
            </tr>";
    }

    echo "</tbody></table>";

    ?>
</div>
<!-- <button onclick='delete_supplier($supplier->Supplier_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i> -->
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
    include_once "../foot.php";
    ?>


<script>
    function delete_supplier(d) {
    if (confirm("Arw you sure you want to delete " + d)) {
        window.location.href = "Manage_supplier.php?did=" + d;
    }
}
</script>