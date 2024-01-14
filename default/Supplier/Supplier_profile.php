<?php
include_once "../head.php";
include_once "supplier.php";
include_once "../Purchase/Purchase.php";

$supplier = new Supplier();
$purchase = new Purchase();

$supplier_id = $_GET['s_id'];

$supplier_details =  $supplier->get_supplier_by_id($supplier_id);
$supplier_purchases = $purchase->get_purchases_by_supplier_id($supplier_id);
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
                                            <h4><?= $supplier_details->Supplier_name ?></h4>
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
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card-body">
                                                            <p class="card-text"><strong>Supplier Name:</strong> <?= $supplier_details->Supplier_name ?> </p>
                                                            <p class="card-text"><strong>Contact Person:</strong> <?= $supplier_details->Supplier_contact_person ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card-body">
                                                            <p class="card-text"><strong>Contact Person Phone Number:</strong> <?= $supplier_details->Supplier_contact_person_phoneNO ?> </p>
                                                            <p class="card-text"><strong>Status:</strong> <?= $supplier_details->Supplier_status ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Display Supplier Purchases -->

                        <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Supplier Purchases</h5>
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
                                                    echo "<table id='basic-btn' class='table table-striped table-bordered nowrap'>
                                                          <thead>
                                                            <tr>
                                                              <th>Purchase ID </th>
                                                              <th>Date</th>
                                                              <th>Total Amount</th>
                                                              <th>Paid Amount</th>
                                                              <th> Balance</th>
                                                            </tr>
                                                          </thead>
                                                          <tbody>";

                                                    foreach ($supplier_purchases as $purchase_item) {
                                                        echo "<tr>
                                                                <td>$purchase_item->Purchase_id</td>
                                                                <td>$purchase_item->Purchase_Date</td>
                                                                <td>$purchase_item->bill_total</td>
                                                                <td>$purchase_item->purchase_paid_amount</td>
                                                                <td>$purchase_item->purchase_balance</td>
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
include_once "../foot.php"
?>