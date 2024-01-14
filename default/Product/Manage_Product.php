<?php
session_start();
// include_once "../head.php";
include_once "product.php";
include_once "../Stock/Stock.php";

$s = new Stock();

$p = new Product;

if (isset($_GET["did"])) {
    $product_id = $_GET["did"];
    $p->delete_product($product_id);

    $s->deleted_product($product_id);
}

$data = $p->get_all_active_products();

if ($_SESSION["user"]["user_role"] == 2) {
    include_once "../head.php";
}  else {
    header("Location:../Login/logout.php");
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
                                                <h4>Manage Product</h4>
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
                                                <h5> Product</h5>
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
                        <th>Description</th>
                        <th>Model</th>
                     
                 
                        <th>Supplier</th>
                        <th>Category</th>
                    
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>";

        foreach ($data as $product) {
            echo "
                <tr>
                    <td>$product->Product_Name</td>
                    <td>$product->Product_Description</td>
                    <td>$product->Product_Model</td>
               
                    <td>$product->Supplier_Name</td>
                    <td>$product->Product_Category_name</td>
                
                    <td>
                        <a class='table_icons' href='Create_New_product.php?p_id=$product->Product_id' title='Edit'><button class='table_btn btn btn-out btn-success btn-square'><i class='tb_i fa-1x fa fa-edit'></i></button></a>
                        <button onclick='delete_product($product->Product_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i>
                    </td>
                </tr>";
        }

        echo "</tbody></table>";

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

    </div>



    <!-- ------------------------------------------------------------------------------------------- -->

    <?php
    include_once "../foot.php"
    ?>


<script>



function delete_product(d) {
    if (confirm("Arw you sure you want to delete " + d)) {
        window.location.href = "Manage_Product.php?did=" + d;
    }
}

</script>