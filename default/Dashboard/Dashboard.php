<?php
session_start();
// include_once "../head.php";
include_once "../Sales/Sales.php";
include_once "../Purchase/Purchase.php";
include_once "../Stock/Stock.php";

$st = new Stock();

$productsBelowReorderLevel = $st->getProductsBelowReorderLevel();

$p = new Purchase();

$purchaseTotal = $p->getTotalPurchases();

$s = new Sales();


$salesTotal = $s->getTotalSales();

if ($_SESSION["user"]["user_role"] == 2) {
    include_once "../head.php";
}  else {
    header("Location:../Login/logout.php");
}
?>





<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $salesTotal ?></h4>
                                            <h6 class="text-white m-b-0">Total Sales</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div> -->
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $purchaseTotal ?></h4>
                                            <h6 class="text-white m-b-0">Total Purchase</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div> -->
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-pink update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">145</h4>
                                                                <h6 class="text-white m-b-0">Task Completed</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-3" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div> 
                                                </div>
                                            </div> -->
                        <!-- <div class="col-xl-3 col-md-6">
                                                <div class="card bg-c-lite-green update-card">
                                                    <div class="card-block">
                                                        <div class="row align-items-end">
                                                            <div class="col-8">
                                                                <h4 class="text-white">500</h4>
                                                                <h6 class="text-white m-b-0">Downloads</h6>
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                <canvas id="update-chart-4" height="50"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer">
                                                        <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i>update : 2:15 am</p>
                                                    </div> 
                                                </div>
                                            </div> -->
                        <!-- task, page, download counter  end -->

                        <!--  sale analytics start -->
                        <div class="col-xl-9 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Low Stock Alert</h5>


                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <?php
                                        echo "
        <table id='basic-btn' class='table table-striped table-bordered nowrap'>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity in Stock</th>
                    <th>Reorder Level</th>
                  
                </tr>
            </thead>
            <tbody>";

                                        foreach ($productsBelowReorderLevel as $product) {
                                            echo "
            <tr>
                <td>$product->product_name</td>
                <td>$product->quantity_in_stock</td>
                <td>$product->reorder_level</td>
               
            </tr>";
                                        }

                                        echo "</tbody></table>";
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-md-12">
                            <div class="card user-card2">
                                <div class="card-block text-center">
                                    <h6 class="m-b-15">Project Risk</h6>
                                    <div class="risk-rate">
                                        <span><b>5</b></span>
                                    </div>
                                    <h6 class="m-b-10 m-t-10">Balanced</h6>
                                    <a href="#!" class="text-c-yellow b-b-warning">Change Your Risk</a>
                                    <div class="row justify-content-center m-t-10 b-t-default m-l-0 m-r-0">
                                        <div class="col m-t-15 b-r-default">
                                            <h6 class="text-muted">Nr</h6>
                                            <h6>AWS 2455</h6>
                                        </div>
                                        <div class="col m-t-15">
                                            <h6 class="text-muted">Created</h6>
                                            <h6>30th Sep</h6>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-warning btn-block p-t-15 p-b-15">Download Overall Report</button>
                            </div>
                        </div> -->



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