<?php
include_once "../head.php";
include_once "../GRN/GRN.php";

$g = new GRN();




if (isset($_GET["did"])) {
    $grnId = $_GET["did"];
    $g->deleteGRN($grnId);
}
$grn = $g->get_all_active_grn();
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
                                                <h4>Manage GRN</h4>
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
                                                <h5>GRN</h5>
                                                <div class="card-header-right">
                                                    <ul class="list-unstyled card-option">
                                                        <li><i class="feather icon-maximize full-card"></i></li>
                                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-block">

                                            <div class="container mt-5">

<div class="dt-responsive table-responsive">
    <?php
    echo "
<table id='basic-btn' class='table table-striped table-bordered nowrap'>

<thead>
<tr>
<th>GRN ID </th>
<th>Supplier</th>
<th>Total Amount</th>
<th>Action</th>


</tr>
</thead>
<tbody>";
    foreach ($grn as $item) {


        echo " 

<tr>
<td>$item->grn_Id</td>
<td>$item->supplier_name</td>
<td>$item->grn_bill_total</td>
 <td>
<a class='table_icons' href='GRN_Profile.php?grn_id=$item->grn_Id' title='View'><button class='table_btn btn btn-out btn-primary btn-square '><i class='tb_i fa-1x fa fa-eye'></i></button></a>
<button onclick='deleteGRN($item->grn_Id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i>

   
</td>



</tr> 


";
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
        function deleteGRN(d) {
    if (confirm("Arw you sure you want to delete " + d)) {
        window.location.href = "Mange_GRN.php?did=" + d;
    }
}
    </script>