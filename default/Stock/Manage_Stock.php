<?php
include_once "../head.php";
include_once "Stock.php";

$s = new Stock;

// if (isset($_GET["did"])) {
//     $product_id = $_GET["did"];
//     $s->delete_stock_item($product_id);
// }

$stock_data = $s->get_all_active_stock();
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
                                            <h4>Manage Stock</h4>
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
                                            <h5> Stock Items</h5>
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
                                                    <table id='basic-btn' class='table table-striped table-bordered nowrap'>
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Quantity In Stock</th>
                                                                <th>Reorder Level</th>
                                                             
                                                              
                                                           
                                                            </tr>
                                                        </thead>
                                                        <tbody>";

                                                    foreach ($stock_data as $stock_item) {
                                                        echo "
                                                        <tr>
                                                            <td>$stock_item->product_name</td>
                                                            <td>$stock_item->quantity_in_stock</td>
                                                            <td>$stock_item->reorder_level</td>
                                                           
                                                           
                                                            
                                                        </tr>";
                                                    }

                                                    echo "</tbody></table>";

                                                    ?>
                                                </div>
                                            </div>
                                            <!-- <td>
                                                                <button onclick='delete_stock_item($stock_item->product_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></i></button>
                                                            </td> -->
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
    function delete_stock_item(d) {
        if (confirm("Are you sure you want to delete this stock item?")) {
            window.location.href = "Manage_stock.php?did=" + d;
        }
    }
</script>
