<?php

include_once "ProductCategory.php";

$pc = new ProductCategory();

if (isset($_GET["did"])) {
    $category_id = $_GET["did"];
    $pc->delete_category($category_id);
}

$data = $pc->get_all_active_product_categories();

if (isset($_GET["cat_id"])) {
    $pc = $pc->get_category_by_id($_GET["cat_id"]);
}



if (isset($_POST["Category_Name"])) {
    $productCategory = new ProductCategory();

    $productCategory->Category_Name = $_POST["Category_Name"];
    $productCategory->Category_Description = $_POST["Category_Description"];

    if (isset($_POST["cat_id"])) {

        $productCategory->update_category($_POST["cat_id"]);
        header("Location:Manage_Product_category.php?e=yes");
    } else {
        $result = $productCategory->insert_product_category();

        header("Location:Manage_Product_category.php?s=yes");
    }
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
                                            <h4>Manage Product Category</h4>
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
                                            <h5> Product Category</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Manage_Product_category.php">
                                                <?php
                                                if (isset($_GET["cat_id"])) {
                                                    echo "
                                                        <input type='text' class='form-control' name='cat_id' id='cat_id'  value='" . $_GET['cat_id'] . " '  placeholder='Enter  first name' hidden required>
";
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <label for="CategoryName">Category Name:</label>
                                                    <input type="text" class="form-control" name="Category_Name" value="<?= $pc->Category_Name ?>" id="Category_Name" placeholder="Enter category name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="CategoryDescription">Category Description:</label>
                                                    <textarea class="form-control" name="Category_Description" id="Category_Description" placeholder="Enter category description"></textarea>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <!-- Page-header end -->

                        <div class="page-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5> Product Category List</h5>
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
               
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";

                                                    foreach ($data as $category) {
                                                        echo "
            <tr>
                <td>$category->Category_Name</td>
                <td>$category->Category_Description</td>
           
                <td>
                    <a class='table_icons' href='Manage_Product_category.php?cat_id=$category->Category_id' title='Edit'><button class='table_btn btn btn-out btn-success btn-square'><i class='tb_i fa-1x fa fa-edit'></i></button></a>
                    <button onclick='delete_category($category->Category_id)' class='table_btn btn btn-out btn-danger btn-square'><i class='tb_i fa-1x fa fa-trash'></button></i>
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
include_once "../foot.php";

if (isset($_GET['s'])) {


    echo '<script>
    swal({
        title: "Success!",
        text: "Category Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_Product_category.php";
      });
    
    </script>';
}
?>


<script>
    function delete_category(category_id) {

        if (confirm("Are you sure you want to delete this category?")) {
            window.location.href = "Manage_Product_category.php?did=" + category_id;
        }
    }
</script>