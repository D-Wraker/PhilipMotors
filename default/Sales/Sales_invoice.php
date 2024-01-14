<?php
include_once "../top.php";
include_once "Sales.php";
include_once "Sales_item.php";



$s = new Sales();
$sales = $s->get_sales_by_id($_GET['s_id']);

$si = new SalesItem();
$sales_items = $si->get_sales_items_by_sale_id($sales->Sale_id);
?>

<div class="container">
    <!-- Main content starts -->
    <div>
        <!-- Invoice card start -->
        <div class="card">
            <div class="row invoice-contact">
                <div class="col-md-8">
                    <div class="invoice-box row">
                        <div class="col-sm-12">
                            <table class="table table-responsive invoice-table table-borderless">
                                <tbody>
                                    <tr>
                                        <td><img src="..\files\assets\images\logo-blue.png" class="m-b-10" alt=""></td>
                                    </tr>
                                    <tr>



                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="card-block">
                <div class="row invoive-info">

                    <div class="col-md-4 col-sm-6">
                        <h6>Invoice Information :</h6>
                        <table class="table table-responsive invoice-table invoice-order table-borderless">
                            <tbody>
                                <tr>
                                    <th>Date :</th>

                                    <td><?= date("Y-m-d"); ?></td>

                                </tr>
                                <tr>

                                    <th>customer Name : </th>

                                    <td><?= $sales->Customer_Name ?></td>
                                </tr>

                                <tr>

                                    <th>Sales Id : </th>

                                    <td><?= $sales->Sale_id ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table  invoice-detail-table">
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
                                                                    <th>Discount</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>";
                                    foreach ($sales_items as $item) {
                                        echo "
                                                            <tr>
                                                                <td>$item->product_id</td>
                                                                <td>$item->Product_Name</td>
                                                                <td>$item->Item_Quantity</td>
                                                                <td>$item->Item_Price</td>
                                                                <td>$item->Item_Discount %</td>
                                                                <td>$item->Item_Amount</td>
                                                            </tr>";
                                    }
                                    echo "</tbody></table>";
                                    ?>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-responsive invoice-table invoice-total">
                            <tbody>
                                <tr>
                                    <th>Total :</th>
                                    <td><?= $sales->bill_total ?></td>
                                </tr>
                                <tr>
                                    <th>Paid Amount :</th>
                                    <td><?= $sales->sales_paid_amount ?></td>
                                </tr>
                                <tr>
                                    <th>Balance :</th>
                                    <td><?= $sales->sales_balance ?></td>
                                </tr>
                                <!-- Additional rows if needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- <div class="row">
                                                            <div class="col-sm-12">
                                                                <h6>Terms And Condition :</h6>
                                                                <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor </p>
                                                            </div>
                                                        </div> -->
            </div>
        </div>
        <!-- Invoice card end -->
        <div class="row text-center">
            <div class="col-sm-12 invoice-btn-group text-center">
                <button type="button" onclick="window.print()" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</button>
                <a class='table_icons' href='Sales_Profile.php?s_id=<?= $sales->Sale_id ?>' title='View'> <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button> </a>
            </div>
        </div>
    </div>
</div>
<!-- Container ends -->
<?php
include_once "../foot.php"
?>