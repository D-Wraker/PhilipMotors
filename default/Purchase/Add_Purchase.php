<?php
session_start();
// include_once "../head.php";
include_once "../Supplier/Supplier.php";
include_once "../Product/Product.php";
include_once "Purchase.php";
include_once "Purchase_item.php";

$purchase_item = new PurchaseItem();

$p = new Product;
$products = $p->get_all_active_products();
$s = new Supplier;
$suppliers = $s->get_all_active_suppliers();

$purchase = new Purchase();

if (isset($_POST["Supplier"])) {
    $purchase->Supplier_id = $_POST["Supplier"];
    $purchase->purchase_balance = $_POST["purchase_balance"];
    $purchase->purchase_paid_amount = $_POST["purchase_paid_amount"];
    $purchase->Purchase_Date = $_POST["Purchase_Date"];
    $purchase->bill_total = $_POST["bill_total"];

    $purchase_id = $purchase->insert_purchase();
    $purchase_item->insert_purchase_items($purchase_id);
    header("Location:Add_Purchase.php?s=yes");
}

if ($_SESSION["user"]["user_role"] == 2) {
    include_once "../head.php";
}  else {
    header("Location:../Login/logout.php");
}
?>

<style>
    .borderless-input {
        border: none;
        outline: none;
    }
</style>

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
                                            <h4>Add Purchase Order</h4>
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
                                            <h5>Add Purchase Order</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Add_Purchase.php">

                                                <!-- Supplier and Purchase Date Row -->
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="Supplier">Supplier:</label> 
                                                        <select class="form-control" id="Supplier" name="Supplier" onchange="getPurchaseItems()" >
                                                            <option value="-1">Select Supplier</option>
                                                            <?php foreach ($suppliers as $supplier) { ?>
                                                                <?php if ($supplier->Supplier_id == $selectedSupplierId) { ?>
                                                                    <option value='<?php echo $supplier->Supplier_id; ?>' selected='selected'><?php echo $supplier->Supplier_name; ?></option>
                                                                <?php } else { ?>
                                                                    <option value='<?php echo $supplier->Supplier_id; ?>'><?php echo $supplier->Supplier_name; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="PurchaseDate">Purchase Date:</label>
                                                        <input type="date" class="form-control" name="Purchase_Date" id="Purchase_Date">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="PurchaseItem">Purchase Item:</label>
                                                        <select class="form-control" id="Purchase_Product_id" name="Purchase_Product_id">
                                                            <option value="-1">Select Product</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="Quantity">Quantity:</label>
                                                        <input type="text" class="form-control" name="Quantity" id="Quantity" placeholder="Enter quantity">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="PurchasePrice">Item Price:</label>
                                                        <input type="text" class="form-control" name="Item_Price" id="Item_Price" placeholder="Enter purchase price">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="PurchasePrice">Discount:</label>
                                                        <input type="text" class="form-control" name="Discount" id="Discount" placeholder="Enter discount">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="ItemAmount">Total Item Amount:</label>
                                                        <input type="text" class="form-control" name="Item_Amount" id="Item_Amount" placeholder="Enter item amount">
                                                    </div>
                                                </div>

                                                <button type="button" onclick="addPurchaseRow(event)" class="btn btn-primary">Add</button>
                                                <br><br>
                                                <hr>
                                                <div class="dt-responsive table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Purchase Item</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="purchaseTableBody">

                                                    </tbody>
                                                </table>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="PurchaseDate">Bill Total:</label>
                                                        <input type="text" class="form-control" name="bill_total" id="bill_total" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="PurchaseDate">Paid Amount:</label>
                                                        <input type="text" class="form-control" name="purchase_paid_amount" id="purchase_paid_amount">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="PurchaseDate">Balance:</label>
                                                        <input type="text" class="form-control" name="purchase_balance" id="purchase_balance" readonly>
                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
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

<!-- ------------------------------------------------------------------------------------------- -->

<?php
include_once "../foot.php";

if (isset($_GET['s'])) {


    echo '<script>
    swal({
        title: "Success!",
        text: "Purchase Order Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_Purchase.php";
      });
    

    
    </script>';
}
?>

<script>
    // Initialize bill_total variable
    var bill_total = 0;

    $(document).ready(function() {
        function isValidNumber(value) {
            return !isNaN(parseFloat(value)) && isFinite(value);
        }

        // Event listener for Quantity, Item_Price, Discount, and Item_Amount input fields
        $('#Quantity, #Item_Price, #Discount, #Item_Amount').on('input', function() {
            var inputValue = $(this).val();

            // Check if the entered value is a valid number
            if (!isValidNumber(inputValue)) {
                alert('Please enter a valid number.');
                // Reset the input value
                $(this).val('');
            }
        });

        $('#purchase_paid_amount').on('input', function() {
            // Get the values of bill_total and purchase_paid_amount
            var billTotal = parseFloat($('#bill_total').val()) || 0;
            var paidAmount = parseFloat($(this).val()) || 0;

            // Check if paidAmount is greater than billTotal
            if (paidAmount > billTotal) {
                alert('Paid amount cannot be greater than the bill total.');
                // Reset the input value
                $(this).val('');
            } else {
                // Calculate the purchase_balance
                var purchaseBalance = billTotal - paidAmount;

                // Update the purchase_balance field
                $('#purchase_balance').val(purchaseBalance.toFixed(2));
            }
        });

        // Add event listeners to input fields
        $("#Quantity, #Item_Price, #Discount").on("input", function() {
            calculateItemAmount();
        });

        function calculateItemAmount() {
            var quantity = parseFloat($("#Quantity").val()) || 0;
            var purchasePrice = parseFloat($("#Item_Price").val()) || 0;
            var discountPercentage = parseFloat($("#Discount").val()) || 0;

            var discountDecimal = discountPercentage / 100;
            var discountedPrice = purchasePrice - (purchasePrice * discountDecimal);
            var itemAmount = quantity * discountedPrice;

            $("#Item_Amount").val(itemAmount.toFixed(2));
        }
    });

    function deletePurchaseRow(t) {
        // Get the amount of the row being deleted
        var deletedAmount = parseFloat($(t).closest("tr").find("td:eq(4)").text()) || 0;

        // Deduct the deleted amount from the bill_total
        bill_total -= deletedAmount;

        // Update the bill_total input
        $("#bill_total").val(bill_total.toFixed(2));

        // Remove the row
        $(t).closest("tr").remove();
    }

    function addPurchaseRow(event) {
        // Get values from form fields

        var purchaseItem1 = $("#Purchase_Product_id option:selected").text();
        var purchaseItem = $("#Purchase_Product_id").val();
        var quantity = $("#Quantity").val();
        var price = $("#Item_Price").val();
        var discount = $("#Discount").val();
        var amount = $("#Item_Amount").val();

        // Check if Item_Price and Quantity are both mandatory fields for the current row
        if (price.trim() === '' || quantity.trim() === '') {
            alert('Please enter values for both Item_Price and Quantity.');
            return; // Don't proceed with adding the row if mandatory fields are not filled
        }

        // Check if Purchase_Product_id is valid
        if (purchaseItem === '-1') {
            alert('Please select a valid value for Purchase Product.');
            return; // Don't proceed with adding the row if Purchase_Product_id is not valid
        }

        bill_total += parseFloat(amount) || 0;

        // Update the bill_total input
        $("#bill_total").val(bill_total.toFixed(2));

        var newRow = $("<tr>" +
            "<td><input type='text' value='" + purchaseItem1 + "' name='' class='borderless-input' readonly> <input type='text' value='" + purchaseItem + "' name='Item_id[]' class='borderless-input' hidden readonly></td>" +
            "<td><input type='text' value='" + quantity + "' name='Item_Quantity[]' class='borderless-input'readonly></td>" +
            "<td><input type='text' value='" + price + "' name='Item_Price[]' class='borderless-input' readonly></td>" +
            "<td><input type='text' value='" + discount + "' name='Item_Discount[]' class='borderless-input' readonly></td>" +
            "<td><input type='text' value='" + amount + "' name='Item_Amount[]' class='borderless-input' readonly></td>" +
            "<td><button type='button' onclick='deletePurchaseRow(this)'>Delete</button></td>" +
            "</tr>");

        $("#purchaseTableBody").append(newRow);

        // Clear form fields
    }







function getPurchaseItems() {
    var supplierId = $("#Supplier").val();

    // Make an AJAX request to fetch purchase items based on the selected supplier
    $.get("../Ajax/ajax.php?type=filter_Product_by_Supplier&ee=" + supplierId, function (data) {
        console.log("AJAX Response:", data);

        var purchaseItems = JSON.parse(data);
        console.log(purchaseItems.Product_id);


        // Clear existing options
        $("#Purchase_Product_id").empty();

        // Add new options based on the fetched data
        purchaseItems.forEach(function (item) {
            $("#Purchase_Product_id").append("<option value='" + item.Product_id + "'>" + item.Product_Name +  "</option>");
        });
    });
}

</script>