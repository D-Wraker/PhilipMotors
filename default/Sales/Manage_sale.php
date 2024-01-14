<?php
session_start();
// include_once "../head.php";
include_once "Sales.php";

$s = new Sales();



if (isset($_GET["did"]))
{
    $sale_id = $_GET["did"];

    $s->revertSaleStock($sale_id);
    $s->delete_sale($sale_id);
}
$sales = $s->get_all_active_sales();


if ($_SESSION["user"]["user_role"] == 2) {
    include_once "../head.php";
}  else {
    header("Location:../Login/logout.php");
}
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
                                            <h4>Manage Sales</h4>
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
                                            <h5>Sales</h5>
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
<th>Sales ID </th>
<th>Customer</th>
<th>Date</th>
<th>Total Amount</th>
<th>Paid Amount</th>
<th> Balance</th>
<th> Action</th>

</tr>
</thead>
<tbody>";
                                                    foreach ($sales as $item) {


                                                        echo " 

<tr>
<td>$item->Sale_id</td>
<td>$item->Customer_Name</td>
<td>$item->Sales_Date</td>
<td>$item->bill_total</td>
<td>$item->sales_paid_amount</td>
<td>$item->sales_balance</td>

<td>
<a class='table_icons' href='Sales_Profile.php?s_id=$item->Sale_id' title='View'><button class='table_btn btn btn-out btn-primary btn-square '><i class='tb_i fa-1x fa fa-eye'></i></button></a>
    <button onclick='deleteSale($item->Sale_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i>
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
    function deleteSale(saleId) {
    if (confirm("Are you sure you want to delete sale with ID " + saleId + "?")) {
        window.location.href = "Manage_sale.php?did=" + saleId;
    }
}

</script>