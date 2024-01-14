<?php
include_once "../head.php";
include_once "Purchase.php";

$p = new Purchase();



// Example usage for deleting a purchase
if (isset($_GET["did"])) {
    $purchase_id = $_GET["did"];

    $p->delete_purchase($purchase_id);
}

$purchase =  $p->get_all_active_purchases();
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
                                            <h4>Manage Purchase</h4>
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
                                            <h5>Purchase</h5>
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
<th>Purchase ID </th>
<th>Supplier</th>
<th>Date</th>
<th>Total Amount</th>
<th>Paid Amount</th>
<th> Balance</th>
<th> Action</th>

</tr>
</thead>
<tbody>";
                                                    foreach ($purchase as $item) {


                                                        echo " 

<tr>
<td>$item->Purchase_id</td>
<td>$item->Supplier_Name</td>
<td>$item->Purchase_Date</td>
<td>$item->bill_total</td>
<td>$item->purchase_paid_amount</td>
<td>$item->purchase_balance</td>

<td>
<a class='table_icons' href='Purchase_Profile.php?p_id=$item->Purchase_id' title='View'><button class='table_btn btn btn-out btn-primary btn-square '><i class='tb_i fa-1x fa fa-eye'></i></button></a>
    
    <button onclick='delete_purchase($item->Purchase_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i>
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
include_once "../foot.php";
?>

<script>
    function delete_purchase(p_id) {
    if (confirm("Are you sure you want to delete Purchase with ID " + p_id + "?")) {
        window.location.href = "Manage_Purchase.php?did=" + p_id;
    }
}

</script>