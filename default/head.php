<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include_once "top.php";

    ?>

</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="index-1.htm">
                            <img class="img-fluid" src="..\..\files\assets\images\logo.png" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="feather icon-maximize full-screen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                          
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <!-- <img src="..\..\files\assets\images\avatar-4.jpg" class="img-radius" alt="User-Profile-Image"> -->
                                        <span></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <!-- <li>
                                            <a href="#!">
                                                <i class="feather icon-settings"></i> Settings
                                            </a>
                                        </li>
                                        <li>
                                            <a href="user-profile.htm">
                                                <i class="feather icon-user"></i> Profile
                                            </a>
                                        </li> -->

                                        <li>
                                            <a href="../Login/logout.php">
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>



            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="..\..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                    
                    </div>
                </div>
                <div class="media chat-messages">
                    
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="..\..\files\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat end-->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="pcoded-navigatio-lavel">Navigation</div>
                            <!--  Dashboard -->

                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="../Dashboard/Dashboard.php">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                </li>

                            </ul>
                            <!-- Customer -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                        <span class="pcoded-mtext">Customer</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="active">
                                            <a href="../Customer/Manage_customer.php ">
                                                <span class="pcoded-mtext">Manage Customer
 </span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../Customer/Create_New_Customer.php">
                                                <span class="pcoded-mtext "> Add Customer</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                            </ul>

                            <!-- Supplier -->

                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-user"></i></span>
                                        <span class="pcoded-mtext">Supplier</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="../Supplier/Manage_supplier.php ">
                                                <span class="pcoded-mtext">Manage Supplier</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../Supplier/Create_New_Supplier.php ">
                                                <span class="pcoded-mtext "> Add Supplier</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                            </ul>
                            <!-- Product -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fas fa-clipboard-user"></i></span>
                                        <span class="pcoded-mtext">Product</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="../Product/Manage_Product.php">
                                                <span class="pcoded-mtext">Manage Product</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../Product_category/Manage_Product_category.php">
                                                <span class="pcoded-mtext">Manage Product Category</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../Product/Create_New_product.php ">
                                                <span class="pcoded-mtext">Add New Product</span>
                                            </a>
                                        </li>


                                    </ul>
                                </li>


                            </ul>

                            <!-- Purchase -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-shopping-basket"></i></span>
                                        <span class="pcoded-mtext">Purchase</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="../Purchase/manage_purchase.php ">
                                                <span class="pcoded-mtext">Manage Purchase</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../Purchase/Add_Purchase.php ">
                                                <span class="pcoded-mtext">Add New Purchase</span>
                                            </a>
                                        </li>



                                    </ul>
                                </li>


                            </ul>


                            <!-- Sales -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-money"></i></span>
                                        <span class="pcoded-mtext">Sales</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="../Sales/Add_Sales.php ">
                                                <span class="pcoded-mtext">Add Sales</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../Sales/Manage_sale.php ">
                                                <span class="pcoded-mtext">Manage Sales</span>
                                            </a>
                                        </li>


                                    </ul>
                                </li>


                            </ul>

                            <!-- GRN -->

                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-file"></i></span>
                                        <span class="pcoded-mtext">GRN</span>
                                    </a>
                                    <ul class="pcoded-submenu">

                                        <li class="">
                                            <a href="../GRN/Mange_GRN.php ">
                                                <span class="pcoded-mtext">Manage GRN</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../GRN/Add_GRN.php ">
                                                <span class="pcoded-mtext">Add New GRN</span>
                                            </a>
                                        </li>



                                    </ul>
                                </li>


                            </ul>

                            <!-- Stock -->

                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-archive"></i></span>
                                        <span class="pcoded-mtext">Stock</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="../Stock/Manage_Stock.php ">
                                                <span class="pcoded-mtext"> Manage_Stock</span>
                                            </a>
                                        </li>
                                        <!-- <li class="">
                                            <a href="../Stock/add_packages.php ">
                                                <span class="pcoded-mtext">Add packages</span>
                                            </a>
                                        </li> -->


                                    </ul>
                                </li>


                            </ul>


                            <!-- Admin -->
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-users"></i></span>
                                        <span class="pcoded-mtext">Admin</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="active">
                                            <a href="../admin/Manage_Admin.php ">
                                                <span class="pcoded-mtext">Manage Admin</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="../admin/Create_New_Admin.php">
                                                <span class="pcoded-mtext "> Add Admin</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                            </ul>


                            <!-- Reports -->
                           <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="fa fa-file-text"></i></i></span>
                                        <span class="pcoded-mtext">Reports</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="active">
                                            <a href="../Reports/Sales_report.php">
                                                <span class="pcoded-mtext">Sales Report</span>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="../Reports/Product_report.php">
                                                <span class="pcoded-mtext">Product Report</span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>


                            </ul> 
                            <!-- <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="http://html.codedthemes.com/Adminty/doc" target="_blank">
                                        <span class="pcoded-micon"><i class="fa fa-file-text"></i></i></span>
                                        <span class="pcoded-mtext">Reports</span>
                                    </a>
                                </li>

                            </ul> -->


                            <!-- <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="http://html.codedthemes.com/Adminty/doc" target="_blank">
                                        <span class="pcoded-micon"><i class="feather icon-monitor"></i></span>
                                        <span class="pcoded-mtext">Documentation</span>
                                    </a>
                                </li>

                            </ul> -->
                        </div>
                    </nav>

                    <body>