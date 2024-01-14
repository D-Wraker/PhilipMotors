<?php
include_once "../head.php";
include_once "../Customer/customer.php";


include_once "../Sales/Sales.php";

$s = new Sales();



$data = $s->getTotalQuantitySoldAndHighestSoldItem();
$salesItems = $data['salesItems'];
$highestSoldItem = $data['highestSoldItem'];
$lowestSoldItem = $data['lowestSoldItem'];
// print_r ($salesItems);
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
                                            <h4>Product Report</h4>
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
                                            <h5></h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                 


                            <div class="row mx-5">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $highestSoldItem->Product_Name ?></h4>
                                            <h6 class="text-white m-b-0">Highest Sold Item </h6>
                                        </div>
                                       
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $lowestSoldItem->Product_Name ?></h4>
                                            <h6 class="text-white m-b-0">Lowest Sold Item</h6>
                                        </div>
                                      
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        </div>
                                        <div class="container mt-5">



                                            <div class="dt-responsive table-responsive">
                                                <?php
                                                echo "
        <table id='basic-btn' class='table table-striped table-bordered nowrap'>
            <thead>
                <tr>
                    <th>Product  ID</th>
                    <th>Product  Name</th>
                    <th>Quantity sold</th>
                    
                </tr>
            </thead>
            <tbody>";



                                                foreach ($salesItems as $item) {
                                                    echo "
            <tr>
                <td>{$item->product_id}</td>
                <td>{$item->Product_Name}</td>
                <td>{$item->Item_Quantity}</td>
            </tr>";
                                                }



                                                echo "
        </tbody></table>";
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



<!-- ------------------------------------------------------------------------------------------- -->

<?php
include_once "../foot.php"
?>