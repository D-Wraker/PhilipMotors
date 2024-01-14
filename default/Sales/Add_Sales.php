<?php
session_start();
// include_once "../head.php";
include_once "../Customer/customer.php";
include_once "../Product/Product.php";
include_once "Sales.php";
include_once "Sales_item.php";

$sales_item = new SalesItem();

$p = new Product;
$products = $p->get_all_active_products();
$c = new customer;

$customers = $c->get_all_active_customers();


$sale = new Sales();



if (isset($_POST["Customer"])) {

    $sale->Customer_id = $_POST["Customer"];
    $sale->sales_balance = $_POST["sales_balance"];
    $sale->sales_paid_amount = $_POST["sales_paid_amount"];
    $sale->Sales_Date = $_POST["Sales_Date"];
    $sale->bill_total = $_POST["bill_total"];

    $sale_id = $sale->insert_sale();
    $sales_item->insert_sales_items($sale_id);
    header("Location:Add_Sales.php?s=yes");
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
                                            <h4>Add Sale</h4>
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
                                            <h5>Add Sale</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Add_Sales.php">

                                                <!-- Customer and Sales Date Row -->
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="Customer">Customer:</label>
                                                        <select class="form-control" id="Customer" name="Customer">
                                                            <option value="-1">Select Customer</option>
                                                            <?php foreach ($customers as $customer) { ?>
                                                                <?php if ($customer->Customer_id == $selectedCustomerId) { ?>
                                                                    <option value='<?php echo $customer->Customer_id; ?>' selected='selected'><?php echo $customer->Customer_Name; ?></option>
                                                                <?php } else { ?>
                                                                    <option value='<?php echo $customer->Customer_id; ?>'><?php echo $customer->Customer_Name; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="SalesDate">Sales Date:</label>
                                                        <input type="date" class="form-control" name="Sales_Date" id="Sales_Date">
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="SalesItem">Sales Item:</label>
                                                        <select class="form-control" id="Sales_Product_id" name="Sales_Product_id">
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
                                                        <label for="Quantity">Quantity:</label>
                                                        <input type="text" class="form-control" name="Quantity" id="Quantity" placeholder="Enter quantity">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="IssuePrice">Item Price:</label>
                                                        <input type="text" class="form-control" name="Item_Price" id="Item_Price" placeholder="Enter issue price">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="IssuePrice">Discount:</label>
                                                        <input type="text" class="form-control" name="Discount" id="Discount" placeholder="Enter issue price">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="ItemAmount">Total Item Amount:</label>
                                                        <input type="text" class="form-control" name="Item_Amount" id="Item_Amount" placeholder="Enter item amount">
                                                    </div>
                                                </div>

                                                <button type="button" onclick="addSalesRow(event)" class="btn btn-primary">Add</button>
                                                <br><br>
                                                <hr>
                                                <div class="dt-responsive table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Sales Item</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Discount</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="salesTableBody">

                                                    </tbody>
                                                </table>
                                                </div>
                                                <br>
                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="SalesDate">Bill Total:</label>
                                                        <input type="text" class="form-control" name="bill_total" id="bill_total" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="SalesDate">Paid Amount:</label>
                                                        <input type="text" class="form-control" name="sales_paid_amount" id="sales_paid_amount">
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="SalesDate">Balance:</label>
                                                        <input type="text" class="form-control" name="sales_balance" id="sales_balance" readonly>
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
        text: "Sales Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_sale.php";
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


        $('#sales_paid_amount').on('input', function() {
            // Get the values of bill_total and sales_paid_amount
            var billTotal = parseFloat($('#bill_total').val()) || 0;
            var paidAmount = parseFloat($(this).val()) || 0;

            // Check if paidAmount is greater than billTotal
            if (paidAmount > billTotal) {
                alert('Paid amount cannot be greater than the bill total.');
                // Reset the input value
                $(this).val('');
            } else {
                // Calculate the sales_balance
                var salesBalance = billTotal - paidAmount;

                // Update the sales_balance field
                $('#sales_balance').val(salesBalance.toFixed(2));
            }
        });

        // Add event listeners to input fields
        $("#Quantity, #Item_Price, #Discount").on("input", function() {
            calculateItemAmount();
        });

        function calculateItemAmount() {
            var quantity = parseFloat($("#Quantity").val()) || 0;
            var issuePrice = parseFloat($("#Item_Price").val()) || 0;
            var discountPercentage = parseFloat($("#Discount").val()) || 0;

            // console.log("Quantity:", quantity);
            // console.log("Issue Price:", issuePrice);
            // console.log("Discount Percentage:", discountPercentage);

            var discountDecimal = discountPercentage / 100;
            // console.log("Discount Decimal:", discountDecimal);

            var discountedPrice = issuePrice - (issuePrice * discountDecimal);
            // console.log("Discounted Price:", discountedPrice);

            var itemAmount = quantity * discountedPrice;
            // console.log("Item Amount:", itemAmount);

            $("#Item_Amount").val(itemAmount.toFixed(2));
        }

    });

    function deleteSalesRow(t) {
        // Get the amount of the row being deleted
        var deletedAmount = parseFloat($(t).closest("tr").find("td:eq(4)").text()) || 0;

        // Deduct the deleted amount from the bill_total
        bill_total -= deletedAmount;

        // Update the bill_total input
        $("#bill_total").val(bill_total.toFixed(2));

        // Remove the row
        $(t).closest("tr").remove();
    }




    function addSalesRow(event) {

 


        // Get values from form fields
        var salesItem1 = $("#Sales_Product_id option:selected").text();
        var salesItem = $("#Sales_Product_id").val();
        var quantity = $("#Quantity").val();
        var price = $("#Item_Price").val();
        var discount = $("#Discount").val();
        var amount = $("#Item_Amount").val();


          // Check if Item_Price and Quantity are both mandatory fields for the current row
    if (price.trim() === '' || quantity.trim() === '') {
        alert('Please enter values for both Item_Price and Quantity.');
        return; // Don't proceed with adding the row if mandatory fields are not filled
    }
 // Check if Sales_Product_id is valid
 if (salesItem === '-1') {
        alert('Please select a valid value for Sales Product.');
        return; // Don't proceed with adding the row if Sales_Product_id is not valid
    }


        bill_total += parseFloat(amount) || 0;

        // Update the bill_total input
        $("#bill_total").val(bill_total.toFixed(2));

        // console.log("salesItem: " + salesItem);
        // console.log("quantity: " + quantity);
        // console.log("price: " + price);
        // console.log("discount: " + discount);
        // console.log("amount: " + amount);



        var newRow = $("<tr>" +
            "<td><input type='text' value='" + salesItem1 + "' name='' class='borderless-input' readonly><input type='text' value='" + salesItem + "' name='Item_id[]' class='borderless-input' hidden readonly></td>" +
            "<td><input type='text' value='" + quantity + "' name='Item_Quantity[]' class='borderless-input'readonly></td>" +
            "<td><input type='text' value='" + price + "' name='Item_Price[]' class='borderless-input' readonly></td>" +
            "<td><input type='text' value='" + discount + "' name='Item_Discount[]' class='borderless-input' readonly></td>" +
            "<td><input type='text' value='" + amount + "' name='Item_Amount[]' class='borderless-input' readonly></td>" +
            "<td><button type='button' onclick='deleteSalesRow(this)'>Delete</button></td>" +
            "</tr>");

        $("#salesTableBody").append(newRow);

        // Clear form fields after adding a row
        $("#Sales_Product_id, #Quantity, #Item_Price, #Discount, #Item_Amount").val("");
    }


    

</script>


