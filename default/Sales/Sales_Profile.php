<?php

include_once "Sales.php"; 
include_once "Sales_item.php"; 
include_once "../Payment/Payment.php";

$py = new Payment();



$s = new Sales();
$sales = $s->get_sales_by_id($_GET['s_id']);

$si = new SalesItem();
$sales_items = $si->get_sales_items_by_sale_id($sales->Sale_id);

$payment_history = $py->get_payment_history($sales->Sale_id);

if (isset($_POST["payment_amount"])) {

    $py->transaction_type = "sales";
    $py->transaction_id = $sales->Sale_id;
    $py->payment_amount = $_POST["payment_amount"];
  
    $payment_id = $py->insert_payment();

     // Update the sales_balance
     $updated_balance = $sales->sales_balance - $_POST["payment_amount"];
     $s->updateSalesBalance($sales->Sale_id, $updated_balance);

} 


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
                                            <h4>Sales Order ID: <?= $sales->Sale_id ?></h4>
                                            <h4>Customer: <?= $sales->Customer_Name ?></h4>
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

                                                <!-- Payment History Table -->
<div class="row mt-4">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Payment History</h5>
            </div>
            <div class="card-block">
                <div class="table-responsive">
                    <?php
                    // Assuming you have a function to get payment history for a sale_id
                    $payment_history = $py->get_payment_history($sales->Sale_id);

                    echo "
                        <table class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th>Payment Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>";

                    foreach ($payment_history as $payment) {
                        echo "
                            <tr>
                                <td>{$payment->payment_amount}</td>
                                <td>{$payment->payment_date}</td>
                            </tr>";
                    }

                    echo "</tbody></table>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

                                                  <!-- Payment Form -->
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Add Payment</h5>
                </div>
                <div class="card-block">
                <form id="paymentForm" method="post" action="Sales_Profile.php?s_id=<?= $sales->Sale_id ?>"> 
                        <div class="form-group row">
                            <label for="payment_amount" class="col-sm-2 col-form-label">Payment Amount:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="payment_amount" name="payment_amount" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-10 offset-sm-2">
                                <input type="hidden" name="sale_id" value="<?= $sales->Sale_id ?>">
                                <button type="submit" class="btn btn-primary">Submit Payment</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center">
                                                    <div class="col-sm-12 invoice-btn-group text-center">
                                                    <a class='table_icons' href='Sales_invoice.php?s_id=<?= $sales->Sale_id ?>' title='View'>      <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Invoice</button></a>
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
</div>

<?php
include_once "../foot.php"
?>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    const paymentForm = document.getElementById("paymentForm");
    const paymentAmountInput = document.getElementById("payment_amount");
    const balance = <?= $sales->sales_balance ?>; // Get the sales balance

    paymentAmountInput.addEventListener("keypress", function (event) {
        const charCode = event.which ? event.which : event.keyCode;

        // Allow only numeric characters (0-9) and the period (.) for decimals
        if ((charCode < 48 || charCode > 57) && charCode !== 46) {
            event.preventDefault();
        }
    });

    paymentForm.addEventListener("submit", function (event) {
        const paymentAmount = parseFloat(paymentAmountInput.value);

        if (isNaN(paymentAmount) || paymentAmount <= 0) {
            alert("Please enter a valid positive number for the payment amount.");
            event.preventDefault(); // Prevent the form from submitting
        } else if (balance <= 0) {
            alert("Cannot add payment when the balance is 0 ");
            event.preventDefault(); // Prevent the form from submitting
        } else if (paymentAmount > balance) {
            alert("Payment amount cannot be greater than the balance");
            event.preventDefault(); // Prevent the form from submitting
        }
    });
});

</script>




