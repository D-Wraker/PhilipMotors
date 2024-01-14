<?php

include_once "GRN.php"; // Assuming you have a GRN class
include_once "GRN_Item.php";

$gri = new GRN_Item();

$grn_item =$gri->get_grn_items_by_grn_id($_GET['grn_id']);


$grn = new GRN();

$grn_id = $_GET['grn_id'];
$grn_details = $grn->get_grn_by_id($grn_id);






include_once "../head.php";
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <div class="d-inline">
                                            <h4>GRN ID: <?= $grn_details->grn_Id ?></h4>
                                            <h4>Supplier: <?= $grn_details->supplier_name ?></h4>
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
                                            <!-- Additional card header content if needed -->
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
                                                        <table id='' class='table table-striped table-bordered nowrap'>
                                                            <thead>
                                                                <tr>
                                                                    <th>Item ID</th>
                                                                    <th>Item</th>
                                                                    <th>Quantity</th>
                                                                    <th>Unit Price</th>
                                                              
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";
                                                    foreach ($grn_item as $item) {
                                                        echo "
                                                            <tr>
                                                                <td>$item->product_id</td>
                                                                <td>$item->Product_Name</td>
                                                                <td>$item->received_quantity</td>
                                                                <td>$item->unit_price</td>
                                                              
                                                                <td>$item->received_amount</td>
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

<?php
include_once "../foot.php";
?>


