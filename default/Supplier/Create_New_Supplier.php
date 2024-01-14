<?php

include_once "Supplier.php";


$s = new Supplier();


if (isset($_GET["s_id"])) {
    $s = $s->get_supplier_by_id($_GET["s_id"]);
}

if (isset($_POST["Supplier_name"])) {
    $s->Supplier_name = $_POST["Supplier_name"];
    $s->Supplier_contact_person = $_POST["Supplier_contact_person"];
    $s->Supplier_contact_person_phoneNO = $_POST["Supplier_contact_person_phoneNO"];
    $s->Supplier_Address = $_POST["Supplier_Address"];


    if (isset($_POST["s_id"])) {
        $s->update_supplier($_POST["s_id"]);
        header("Location:Create_New_Supplier.php?e=yes");
    } else {
        $result = $s->insert_supplier();

         header("Location:Create_New_Supplier.php?s=yes");
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
                                            <h4> <?php
                                                    if (isset($_GET["c_id"])) {
                                                        echo "Edit Supplier";
                                                    } else
                                                        echo "Add New Supplier"

                                                    ?></h4>
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
                                            <h5>Supplier Form</h5>
                                            <div class="card-header-right">
                                                <ul class="list-unstyled card-option">
                                                    <li><i class="feather icon-maximize full-card"></i></li>
                                                    <li><i class="feather icon-minus minimize-card"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-block">
                                            <form method="POST" action="Create_New_Supplier.php">

                                                <?php
                                                if (isset($_GET["s_id"])) {
                                                    echo "
                                                        <input type='text' class='form-control' name='s_id' id='c_id'  value='" . $_GET['s_id'] . " '  hidden required>
";
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <label for="SupplierName">Supplier Name:</label>
                                                    <input type="text" class="form-control" name="Supplier_name" id="Supplier_name" value="<?= $s->Supplier_name ?>" placeholder="Enter supplier name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="ContactPerson">Contact Person:</label>
                                                    <input type="text" class="form-control" name="Supplier_contact_person" id="Supplier_contact_person" value="<?= $s->Supplier_contact_person ?>" placeholder="Enter contact person">
                                                </div>
                                                <div class="form-group">
                                                    <label for="ContactPersonPhone">Contact Person Phone Number:</label>
                                                    <input type="tel" class="form-control" name="Supplier_contact_person_phoneNO" id="Supplier_contact_person_phoneNO" value="<?= $s->Supplier_contact_person_phoneNO ?>" placeholder="Enter contact person phone number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="SupplierStatus">Supplier Address:</label>
                                                    <input type="text" class="form-control" name="Supplier_Address" id="Supplier_Address" value="<?= $s->Supplier_Address ?>" placeholder="Enter supplier Address">
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
        text: "Supplier Successfully Added",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_supplier.php";
      });
    

    
    </script>';
}


if (isset($_GET['e'])) {


    echo '<script>
    swal({
        title: "Success!",
        text: "Supplier Details Successfully Edited",
        icon: "success",
        button: "Ok",
    }).then(function() {
        window.location.href = "Manage_supplier.php";
      });
    

    
    </script>';
}
?>