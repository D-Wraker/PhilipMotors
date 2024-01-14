<?php

include_once "../Product/Product.php";
include_once "../Supplier/Supplier.php";
include_once "../Product_category/ProductCategory.php";


$p = new Product();


$pc = new ProductCategory;
$ProductCategory = $pc->get_all_active_product_categories();

$s = new Supplier;
$sup = $s->get_all_active_suppliers();


if (isset($_GET["p_id"])) {
    $p = $p->get_product_by_id($_GET["p_id"]);
}

if (isset($_POST["Product_Name"])) {

    $p->Product_Name = $_POST["Product_Name"];
    $p->Product_Description = $_POST["Product_Description"];
    $p->Product_Model = $_POST["Product_Model"];
    // $p->Product_Price = $_POST["Product_Price"];
     $p->Product_QuantityInStock = $_POST["Product_QuantityInStock"];
    $p->Product_reorder_level = $_POST["Product_reorder_level"];
    $p->Product_Supplier = $_POST["Product_Supplier"];
    $p->Product_Category = $_POST["Product_Category"];

    if (isset($_POST["p_id"])) {
        $p->update_product($_POST["p_id"]);
        header("Location: Create_New_product.php?e=yes");
    } else {
        $result = $p->insert_product();
        header("Location: Create_New_product.php?s=yes");
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
                                            <h4>Add New Product</h4>
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
                                            <h5>Product</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" id="Create_New_Product" action="Create_New_Product.php">

                                                <?php
                                                if (isset($_GET["p_id"])) {
                                                    echo "
                                                        <input type='text' class='form-control' name='p_id' id='p_id'  value='" . $_GET['p_id'] . " '  placeholder='Enter  first name' hidden required>
";
                                                }
                                                ?>

                                                <div class="form-group">
                                                    <label for="ProductName">Product Name:</label>
                                                    <input type="text" class="form-control" name="Product_Name" id="Product_Name" value="<?= $p->Product_Name ?>" placeholder="Enter product name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ProductDescription">Product Description:</label>
                                                    <textarea class="form-control" name="Product_Description" id="Product_Description" value="<?= $p->Product_Description ?>" placeholder="Enter product description"><?= $p->Product_Description ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ProductModel">Product Model:</label>
                                                    <input type="text" class="form-control" name="Product_Model" id="Product_Model" value="<?= $p->Product_Model ?>" placeholder="Enter product model">
                                                </div>

                                                <!-- <div class="form-group">
                                                    <label for="ProductPrice">Product Price:</label>
                                                    <input type="text" class="form-control" name="Product_Price" id="Product_Price" value="<?= $p->Product_Price ?>" placeholder="Enter product price">
                                                </div>
 -->
                                                <div class="form-group">
                                                    <label for="ProductQuantity">Product Quantity In Stock:</label>
                                                    <input type="text" class="form-control" name="Product_QuantityInStock" id="Product_QuantityInStock" value="<?= $p->Product_QuantityInStock ?>" placeholder="Enter product quantity in stock" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ProductQuantity">Re Order level:</label>
                                                    <input type="text" class="form-control" name="Product_reorder_level" id="Product_reorder_level" value="<?= $p->Product_reorder_level ?>" placeholder="Enter product Product_reorder_level" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ProductSupplier">Product Supplier:</label>
                                                    <select class="form-control" id="Product_Supplier" name="Product_Supplier" required>
                                                        <option value="-1">Select Supplier</option>
                                                        <?php foreach ($sup as $item) {
                                                            if ($item->Supplier_id == $p->Product_Supplier)
                                                                echo "<option value='$item->Supplier_id' selected='selected' > $item->Supplier_name </option>";
                                                            else
                                                                echo "<option value='$item->Supplier_id' >$item->Supplier_name </option>";
                                                        } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ProductCategory">Product Category:</label>
                                                    <!-- <input type="text" class="form-control" name="Product_Category" id="Product_Category" placeholder="Enter product category"> -->
                                                    <select class="form-control" id="Product_Category" name="Product_Category" required>
                                                        <option value="-1">Select Category</option>
                                                        <?php foreach ($ProductCategory as $item) {
                                                            if ($item->Category_id == $p->Product_Category)
                                                                echo "<option value='$item->Category_id' selected='selected'>$item->Category_Name </option>";
                                                            else
                                                                echo "<option value='$item->Category_id' >$item->Category_Name </option>";
                                                        } ?>
                                                    </select>
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
        text: "Product Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_Product.php";
      });
    

    
    </script>';
}

if (isset($_GET['e'])) {


    echo '<script>
    
  
  swal({
      title: "Success!",
      text: "Product Successfully Edited",
      icon: "success",
      button: "Ok",
    }).then(function() {
      window.location.href = "Manage_Product.php";
    });
  
    
    </script>';
  }

?>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        var form = document.getElementById("Create_New_Product");

        form.addEventListener("submit", function (event) {
            var productSupplier = document.getElementById("Product_Supplier").value;
            var productCategory = document.getElementById("Product_Category").value;
            var productQuantityInStock = document.getElementById("Product_QuantityInStock").value;
            var reorderLevel = document.getElementById("Product_reorder_level").value;

            // Validate Product Supplier and Product Category
            if (productSupplier === "-1" && productCategory === "-1") {
                alert("Please select a valid Product Supplier and Product Category.");
                event.preventDefault(); // Prevent the form from submitting
            } else if (productSupplier === "-1") {
                alert("Please select a valid Product Supplier.");
                event.preventDefault(); // Prevent the form from submitting
            } else if (productCategory === "-1") {
                alert("Please select a valid Product Category.");
                event.preventDefault(); // Prevent the form from submitting
            }

            // Validate numeric input for Product Quantity In Stock
            if (!isNumeric(productQuantityInStock)) {
                alert("Please enter a valid numeric value for Product Quantity In Stock.");
                event.preventDefault(); // Prevent the form from submitting
            }

            // Validate numeric input for Re Order level
            if (!isNumeric(reorderLevel)) {
                alert("Please enter a valid numeric value for Re Order level.");
                event.preventDefault(); // Prevent the form from submitting
            }
        });

        function isNumeric(value) {
            // Check if the value is a valid number
            return !isNaN(parseFloat(value)) && isFinite(value);
        }
    });
</script>






