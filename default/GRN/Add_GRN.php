<?php

include_once "../Product/Product.php";
include_once "../Supplier/Supplier.php";
include_once "GRN_Item.php";
include_once "GRN.php";


$s = new Supplier();
$p = new Product();
$grn_item = new GRN_Item();
$grn = new GRN();

$suppliers = $s->get_all_active_suppliers();
$products = $p->get_all_active_products();

if (isset($_POST["Supplier"])) {

    $grn->grn_supplierId = $_POST["Supplier"];
    // Assuming these fields are part of your GRN class
    $grn->grn_bill_total = $_POST["grn_bill_total"];
    // Add other fields as needed
    $grn->grn_receiptDate = $_POST["grn_receiptDate"];

    $grn_id = $grn->insert_grn();
    $grn_item->insert_grn_items($grn_id);

    header("Location:Add_GRN.php?s=yes");
}
include_once "../head.php";
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
                                            <h4>Add GRN </h4>
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
                                            <h5>GRN </h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">

                                            <form method="POST" action="Add_GRN.php">

                                                <!-- Supplier and Receipt Date Row -->
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="Supplier">Supplier:</label>
                                                        <select class="form-control" id="Supplier" name="Supplier" onchange="getGRNItems()">
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
                                                        <label for="ReceiptDate">Receipt Date:</label>
                                                        <input type="date" class="form-control" name="grn_receiptDate" id="grn_receiptDate">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="Product">Received Product:</label>
                                                        <select class="form-control" id="Received_Product_id" name="Received_Product_id">
                                                            <option value="-1">Select Product</option>
                                                            <?php foreach ($products as $product) { ?>
                                                                <?php if ($product->Product_id == $selectedProductId) { ?>
                                                                    <option value='<?php echo $product->Product_id; ?>' selected='selected'><?php echo $product->Product_Name; ?></option>
                                                                <?php } else { ?>
                                                                    <option value='<?php echo $product->Product_id; ?>'><?php echo $product->Product_Name; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="ReceivedQuantity">Received Quantity:</label>
                                                        <input type="text" class="form-control" name="Received_Quantity" id="Received_Quantity" placeholder="Enter received quantity">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="UnitPrice">Unit Price:</label>
                                                        <input type="text" class="form-control" name="Unit_Price" id="Unit_Price" placeholder="Enter unit price">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="ReceivedAmount">Total Received Amount:</label>
                                                        <input type="text" class="form-control" name="Received_Amount" id="Received_Amount" placeholder="Enter received amount">
                                                    </div>
                                                </div>

                                                <button type="button" onclick="addGRNRow(event)" class="btn btn-primary">Add</button>
                                                <br><br>
                                                <hr>
                                                <div class="dt-responsive table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Received Product</th>
                                                            <th>Received Quantity</th>
                                                            <th>Unit Price</th>
                                                            <th>Total Received Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="grnTableBody">

                                                    </tbody>
                                                </table>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="ReceiptDate">Total Bill Amount:</label>
                                                        <input type="text" class="form-control" name="grn_bill_total" id="grn_bill_total" readonly>
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
        text: "GRN Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Mange_GRN.php";
      });
    

    
    </script>';
}
?>

<script>
    $(document).ready(function() {

        function isValidNumber(value) {
            return !isNaN(parseFloat(value)) && isFinite(value);
        }

        // Event listener for Received_Quantity, Unit_Price, and Received_Amount input fields
        $('#Received_Quantity, #Unit_Price, #Received_Amount').on('input', function() {
            var inputValue = $(this).val();

            // Check if the entered value is a valid number
            if (!isValidNumber(inputValue)) {
                alert('Please enter a valid number.');
                // Reset the input value
                $(this).val('');
            }
        });

        $('#grn_paid_amount').on('input', function() {
            // Get the values of grn_bill_total and grn_paid_amount
            var grnBillTotal = parseFloat($('#grn_bill_total').val()) || 0;
            var paidAmount = parseFloat($(this).val()) || 0;

            // Check if paidAmount is greater than grnBillTotal
            if (paidAmount > grnBillTotal) {
                alert('Paid amount cannot be greater than the GRN total.');
                // Reset the input value
                $(this).val('');
            } else {
                // Calculate the grn_balance
                var grnBalance = grnBillTotal - paidAmount;

                // Update the grn_balance field
                $('#grn_balance').val(grnBalance.toFixed(2));
            }
        });

        // Add event listeners to input fields
        $("#Received_Quantity, #Unit_Price").on("input", function() {
            calculateReceivedAmount();
        });

        function calculateReceivedAmount() {
            var quantity = parseFloat($("#Received_Quantity").val()) || 0;
            var unitPrice = parseFloat($("#Unit_Price").val()) || 0;

            var receivedAmount = quantity * unitPrice;

            $("#Received_Amount").val(receivedAmount.toFixed(2));
        }

    });



    function deleteGRNRow(t) {
        // Get the amount of the row being deleted
        var deletedAmount = parseFloat($(t).closest("tr").find("td:eq(3)").find("input").val()) || 0;

        // Deduct the deleted amount from the grn_bill_total
        grn_bill_total -= deletedAmount;

        // Update the grn_bill_total input
        $("#grn_bill_total").val(grn_bill_total.toFixed(2));

        // Remove the row
        $(t).closest("tr").remove();
    }



    function addGRNRow(event) {
        // Get values from form fields
        var receivedProduct1 = $("#Received_Product_id option:selected").text();

        var receivedProduct = $("#Received_Product_id").val();
        var receivedQuantity = $("#Received_Quantity").val();
        var unitPrice = $("#Unit_Price").val();
        var receivedAmount = $("#Received_Amount").val();

        // Check if Unit_Price and Received_Quantity are both mandatory fields for the current row
        if (unitPrice.trim() === '' || receivedQuantity.trim() === '') {
            alert('Please enter values for both Unit_Price and Received_Quantity.');
            return; // Don't proceed with adding the row if mandatory fields are not filled
        }

        // Check if Received_Product_id is valid
        if (receivedProduct === '-1') {
            alert('Please select a valid value for Received Product.');
            return; // Don't proceed with adding the row if Received_Product_id is not valid
        }

        // Ensure grn_bill_total is a number before using toFixed method
        grn_bill_total = (typeof grn_bill_total === 'number') ? grn_bill_total : 0;

        grn_bill_total += parseFloat(receivedAmount) || 0;

        // Update the grn_bill_total input
        $("#grn_bill_total").val(grn_bill_total.toFixed(2));

        var newRow = $("<tr>" +
        "<td><input type='text' value='" + receivedProduct1 + "' name='' class='borderless-input' readonly><input type='text' value='" + receivedProduct + "' name='Received_Product_id[]' class='borderless-input' hidden readonly></td>" +
            "<td><input type='text' value='" + receivedQuantity + "' name='Received_Quantity[]' class='borderless-input' readonly></td>" +
            "<td><input type='text' value='" + unitPrice + "' name='Unit_Price[]' class='borderless-input' readonly></td>" +
            "<td><input type='text' value='" + receivedAmount + "' name='Received_Amount[]' class='borderless-input' readonly></td>" +
            "<td><button type='button' onclick='deleteGRNRow(this)'>Delete</button></td>" +
            "</tr>");

        $("#grnTableBody").append(newRow);

        // Clear form fields after adding a row
        $("#Received_Product_id, #Received_Quantity, #Unit_Price, #Received_Amount").val("");
    }




    function getGRNItems() {
    var supplierId = $("#Supplier").val();

    // Make an AJAX request to fetch GRN items based on the selected supplier
    $.get("../Ajax/ajax.php?type=filter_Product_by_Supplier&ee=" + supplierId, function (data) {
        console.log("AJAX Response:", data);

        var grnItems = JSON.parse(data);
        console.log(grnItems.Product_id);

        // Clear existing options
        $("#Received_Product_id").empty();

        // Add new options based on the fetched data
        grnItems.forEach(function (item) {
            $("#Received_Product_id").append("<option value='" + item.Product_id + "'>" + item.Product_Name + "</option>");
        });
    });
}

</script>