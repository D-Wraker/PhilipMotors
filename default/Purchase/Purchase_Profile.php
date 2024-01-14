<?php
include_once "../head.php";
include_once "Purchase.php";
include_once "Purchase_item.php";
include_once "../Payment/Payment.php";

$py = new Payment();


$p = new Purchase();
$purchase = $p->get_purchase_by_id($_GET['p_id']);

$pi = new PurchaseItem();
$purchase_item = $pi->get_purchase_items_by_purchase_id($purchase->Purchase_id);


if (isset($_POST["payment_amount"])) {

    // Assuming you have a Purchase instance called $purchase
    $py->transaction_type = "purchase";
    $py->transaction_id = $purchase->Purchase_id;
    $py->payment_amount = $_POST["payment_amount"];


    // Insert the payment record
    $payment_id = $py->insert_payment();

    // Update the purchase_balance
    $updated_balance = $purchase->purchase_balance - $_POST["payment_amount"];
    $purchase->updatePurchaseBalance($purchase->Purchase_id, $updated_balance);
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
                                            <h4>Purchase Order ID : <?= $purchase->Purchase_id ?></h4>
                                            <h4>Supplier: <?= $purchase->Supplier_Name ?></h4>
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
                                            <!-- <h5>Hello Card</h5> -->
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <div class="container ">

                                                <div class="dt-responsive table-responsive">
                                                    <?php
                                                    echo "
<table id='' class='table table-striped table-bordered nowrap'>

<thead>
<tr>
<th>Item ID </th>
<th>Item  </th>
<th>Quantity</th>
<th>Unit Price</th>
<th>Discount</th>
<th> Total</th>

</tr>
</thead>
<tbody>";
                                                    foreach ($purchase_item as $item) {


                                                        echo " 

<tr>
<td>$item->product_id</td>
<td>$item->Product_Name</td>
<td>$item->Item_Quantity</td>
<td>$item->Item_price  </td>
<td>$item->Item_Discount %</td>
<td>$item->Item_Amount</td>


</tr> 


";
                                                    }


                                                    echo "</tbody></table>";

                                                    ?>


                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-responsive invoice-table invoice-total">
                                                        <tbody>
                                                            <tr>
                                                                <th> Total :</th>
                                                                <td> <?= $purchase->bill_total ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Paid Amount :</th>
                                                                <td> <?= $purchase->purchase_paid_amount ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Balance :</th>
                                                                <td><?= $purchase->purchase_balance ?></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <!-- Payment History Table for Purchase -->
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Payment History</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="table-responsive">
                                                                <?php
                                                                // Assuming you have a function to get payment history for a purchase_id
                                                                $purchase_payment_history = $py->get_purchase_payment_history($purchase->Purchase_id);

                                                                echo "
                        <table class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th>Payment Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>";

                                                                foreach ($purchase_payment_history as $payment) {
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

                                            <!-- Payment Form for Purchase -->
                                            <div class="row mt-4">
                                                <div class="col-sm-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Add Payment</h5>
                                                        </div>
                                                        <div class="card-block">
                                                            <form id="purchasePaymentForm" method="post" action="Purchase_Profile.php?p_id=<?= $purchase->Purchase_id ?>">
                                                                <div class="form-group row">
                                                                    <label for="payment_amount" class="col-sm-2 col-form-label">Payment Amount:</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="payment_amount" name="payment_amount" required>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row">
                                                                    <div class="col-sm-10 offset-sm-2">
                                                                        <input type="hidden" name="purchase_id" value="<?= $purchase->Purchase_id ?>">
                                                                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                                                                    </div>
                                                                </div>
                                                            </form>
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

</div>



<!-- ------------------------------------------------------------------------------------------- -->

<?php
include_once "../foot.php"
?>


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const purchasePaymentForm = document.getElementById("purchasePaymentForm");
        const paymentAmountInput = document.getElementById("payment_amount");
        const balance = <?= $purchase->purchase_balance ?>; // Get the purchase balance

        paymentAmountInput.addEventListener("keypress", function (event) {
            const charCode = event.which ? event.which : event.keyCode;

            // Allow only numeric characters (0-9) and the period (.) for decimals
            if ((charCode < 48 || charCode > 57) && charCode !== 46) {
                event.preventDefault();
            }
        });

        purchasePaymentForm.addEventListener("submit", function (event) {
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

