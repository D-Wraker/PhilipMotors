<?php
include_once "../head.php";
include_once "../Customer/customer.php";


include_once "../Sales/Sales.php";

$s = new Sales();
if (isset($_POST["filter_btn"])) {


    $customer_id = $_POST["customer_id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    $salesResult  = $s->getFilteredSales($customer_id, $start_date, $end_date);


    $filteredSales = $salesResult['filteredSales'];

    $sumBillTotal = $salesResult['sumBillTotal'];

    // $highestSoldItem =$salesResult ['highestSoldItem'];
} else {

    // $sales = $s->getFilteredSales();

    $salesResult = $s->getFilteredSales();
    $filteredSales = $salesResult['filteredSales'];
    $sumBillTotal = $salesResult['sumBillTotal'];
 
    // $highestSoldItem = $salesResult['highestSoldItem']; 
}




$c = new customer;

$customers = $c->get_all_active_customers();










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
                                            <h4>Sales Report</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <!-- <div class="page-header-breadcrumb">
                                            <ul class="breadcrumb-title">
                                                <li class="breadcrumb-item">
                                                    <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="#!">Widget</a> </li>
                                            </ul>
                                        </div> -->
                                </div>
                            </div>
                        </div>
                        <!-- Page-header end -->

                        <div class="page-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5></h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Sales_report.php" id="Filter_Sales_Form" class="row">

                                                <div class="form-group col-md-4">
                                                    <label for="CustomerFilter">Customer:</label>
                                                    <select class="form-control" id="CustomerFilter" name="customer_id">
                                                        <option value="-1">Select Customer</option>
                                                        <!-- Populate with customers -->
                                                        <?php foreach ($customers as $customer) { ?>
                                                            <option value="<?= $customer->Customer_id ?>"><?= $customer->Customer_Name ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <!-- You can add a similar dropdown for suppliers if needed -->

                                                <div class="form-group col-md-4">
                                                    <label for="StartDate">Start Date:</label>
                                                    <input type="date" class="form-control" id="StartDate" name="start_date">
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="EndDate">End Date:</label>
                                                    <input type="date" class="form-control" id="EndDate" name="end_date">
                                                </div>

                                                <div class="form-group col-md-12 mt-3">
                                                    <button type="submit" name="filter_btn" class="btn btn-primary">Filter Sales</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="container mt-5">

                                      

                                            <div class="dt-responsive table-responsive">
                                                <?php
                                                echo "
        <table id='basic-btn' class='table table-striped table-bordered nowrap'>
            <thead>
                <tr>
                    <th>Sales ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                  
                    <th>Paid Amount</th>
                    <th>Balance</th>
                    <th>Total Amount</th>
                    
                </tr>
            </thead>
            <tbody>";

                                                // $salesResult = $s->getFilteredSales();
                                                $filteredSales = $salesResult['filteredSales'];
                                                $sumBillTotal = $salesResult['sumBillTotal'];

                                                foreach ($filteredSales as $item) {
                                                    echo "
            <tr>
                <td>{$item->Sale_id}</td>
                <td>{$item->Customer_Name}</td>
                <td>{$item->Sales_Date}</td>
              
                <td>{$item->sales_paid_amount}</td>
                <td>{$item->sales_balance}</td>
                <td>{$item->bill_total}</td>
            </tr>";
                                                }



                                                echo "
        </tbody></table>";
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-responsive invoice-table invoice-total">
                                                    <tbody>
                                                        <tr>
                                                            <th>Total Sales:</th>
                                                            <td><?= $sumBillTotal ?></td>
                                                        </tr>

                                                        <!-- Additional rows if needed -->
                                                    </tbody>
                                                </table>
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