<?php
include_once "../config.php";
include_once "Sales_item.php";

class Sales
{
    public $Sale_id;
    public $Customer_id;
    public $sales_balance;
    public $sales_paid_amount;
    public $Sales_Date;
    public $bill_total;
    public $Sale_Timestamp;
    public $sales_status;

    public $Customer_Name;

    private $db;


    function __construct()
    {

        $this->db = new mysqli(host, un, password, db); // create database connection 
    }
    
    //----------------------------------------------------

    function insert_sale()
    {
        // Insert the sale record
        $sql_sale = "INSERT INTO Sales (Customer_id, sales_balance, sales_paid_amount, Sales_Date, bill_total)
                VALUES ('$this->Customer_id', '$this->sales_balance', '$this->sales_paid_amount', '$this->Sales_Date', '$this->bill_total')";
    
        $this->db->query($sql_sale);
        $sale_id = $this->db->insert_id;
    
        // Insert the payment record
        $sql_payment = "INSERT INTO payment (transaction_type, transaction_id, payment_amount, payment_status)
                VALUES ('sales', '$sale_id', '$this->sales_paid_amount',  'completed')";
    
        $this->db->query($sql_payment);
        $payment_id = $this->db->insert_id;
    
        return $sale_id;
    }


    // -------------------------------------------

    function delete_sale($sale_id)
{
    $sql = "UPDATE Sales SET sales_status='deleted'
            WHERE Sale_id = $sale_id";

    $this->db->query($sql);
}

    
   

    //----------------------------------------------------
    function get_all_active_sales()
    {
        $sql = "SELECT s.*, c.Customer_Name
                FROM `Sales` s
                JOIN `customer` c ON s.Customer_id = c.Customer_id
                WHERE s.`sales_status` = 'Active'";
        
        $res = $this->db->query($sql);
    
        $all_sales = [];
    
        while ($row = $res->fetch_array()) {
            $s = new Sales();
    
            $s->Sale_id = $row["Sale_id"];
            $s->Customer_id = $row["Customer_id"];
            $s->Customer_Name = $row["Customer_Name"];
            $s->sales_balance = $row["sales_balance"];
            $s->sales_paid_amount = $row["sales_paid_amount"];
            $s->Sales_Date = $row["Sales_Date"];
            $s->bill_total = $row["bill_total"];
            $s->sales_status = $row["sales_status"];
            $s->Sale_Timestamp = $row["Sale_Timestamp"];
    
            $all_sales[] = $s;
        }
    
        return $all_sales;
    }
    
    function get_sales_by_id($sales_id)
    {
        $sql = "SELECT s.*, c.Customer_Name
                FROM sales s
                JOIN customer c ON s.Customer_id = c.Customer_id
                WHERE s.Sale_id = $sales_id";
    
        $res = $this->db->query($sql);
    
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_array();
    
            $s = new Sales();
    
            $s->Sale_id = $row["Sale_id"];
            $s->Customer_id = $row["Customer_id"];
            $s->Customer_Name = $row["Customer_Name"];  // Added customer name
            $s->sales_balance = $row["sales_balance"];
            $s->sales_paid_amount = $row["sales_paid_amount"];
            $s->Sales_Date = $row["Sales_Date"];
            $s->bill_total = $row["bill_total"];
            $s->sales_status = $row["sales_status"];
    
            return $s;
        }
    
        // Return null or handle the case when the sales with the given ID is not found
        return null;
    }
    
   

    // ----------------------------------------------------------------------------

    function get_sales_by_customer_id($customer_id)
    {
        $sql = "SELECT * FROM `Sales`
            WHERE `Customer_id` = '$customer_id' AND sales_status ='Active'";
        $res = $this->db->query($sql);

        $customer_sales = [];

        while ($row = $res->fetch_array()) {
            $s = new Sales();

            $s->Sale_id = $row["Sale_id"];
            $s->Customer_id = $row["Customer_id"];
            $s->sales_balance = $row["sales_balance"];
            $s->sales_paid_amount = $row["sales_paid_amount"];
            $s->Sales_Date = $row["Sales_Date"];
            $s->bill_total = $row["bill_total"];
            $s->sales_status = $row["sales_status"];
            $s->Sale_Timestamp = $row["Sale_Timestamp"];

            $customer_sales[] = $s;
        }
        return $customer_sales;
    }


//-----------------------------------------------------------------

    function updateSalesBalance($sale_id, $new_balance)
{
    $sql_update_balance = "UPDATE Sales SET sales_balance = '$new_balance' WHERE Sale_id = '$sale_id'";
    $this->db->query($sql_update_balance);
}

//------------------------------------------------------------------
function getTotalSales($startDate = null, $endDate = null)
    {
        $sql = "SELECT SUM(bill_total) AS total_sales FROM Sales  WHERE `sales_status` = 'Active'";

        // If start date and end date are provided, include them in the query
        if ($startDate && $endDate) {
            $sql .= " WHERE Sales_Date BETWEEN '$startDate' AND '$endDate'";
        }

        $res = $this->db->query($sql);

        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_array();
            return $row["total_sales"];
        }

        // Return 0 if there are no sales or an error occurs
        return 0;
    }



    function getProductsSoldInSale($saleId) {
        $sql = "SELECT  `Sales_Product_id`, `quantity` FROM sales_items WHERE sale_id = '$saleId'";
        $result = $this->db->query($sql);

        $productsSold = [];

        while ($row = $result->fetch_object()) {
            $productsSold[] = $row;
        }

        return $productsSold;
    }


    function revertSaleStock($saleId) {
        // Retrieve products and quantities sold in the specified sale
        $productsSold = $this->getProductsSoldInSale($saleId);

        // Update the stock by adding back the quantities
        foreach ($productsSold as $product) {
            $this->addStock($product->Sales_Product_id, $product->quantity);

           
        }

        // print_r(  $productsSold); 
    }

    function addStock($productId, $quantity) {
      
        $sql = "UPDATE stock SET quantity_in_stock = quantity_in_stock + $quantity WHERE product_id = '$productId'";
        $this->db->query($sql);
    }

//------------------------------------------------------------------------------------------------



// function getFilteredSales($customer_id = null, $start_date = null, $end_date = null)
// {
//     // Initialize the WHERE clause
//     $whereClause = "s.sales_status = 'Active'";

//     // Add conditions based on provided filters
//     if ($customer_id !== null && $customer_id != -1) {
//         $whereClause .= " AND s.Customer_id = $customer_id";
//     }

//     if ($start_date !== null && $start_date !== '') {
//         $whereClause .= " AND s.Sales_Date = '$start_date'";
//     }

//     if ($end_date !== null && $end_date !== '') {
//         $whereClause .= " AND s.Sales_Date = '$end_date'";
//     }

//     // Add conditions for date range only if both start_date and end_date are provided
//     if ($start_date !== null && $end_date !== null && $start_date !== '' && $end_date !== '') {
//         $whereClause .= " AND (s.Sales_Date BETWEEN '$start_date' AND '$end_date')";
//     }

//     $sql = "SELECT s.*, c.Customer_Name
//             FROM `Sales` s
//             JOIN `customer` c ON s.Customer_id = c.Customer_id
//             WHERE $whereClause";

//     $res = $this->db->query($sql);

//   echo $sql;

//     $filteredSales = [];
//     $sumBillTotal = 0; // Initialize sum variable

//     while ($row = $res->fetch_assoc()) {
//         $s = new Sales();

//         $s->Sale_id = $row["Sale_id"];
//         $s->Customer_id = $row["Customer_id"];
//         $s->Customer_Name = $row["Customer_Name"];
//         $s->sales_balance = $row["sales_balance"];
//         $s->sales_paid_amount = $row["sales_paid_amount"];
//         $s->Sales_Date = $row["Sales_Date"];
//         $s->bill_total = $row["bill_total"];
//         $s->sales_status = $row["sales_status"];
//         $s->Sale_Timestamp = $row["Sale_Timestamp"];

//         $filteredSales[] = $s;

//         // Add each $s->bill_total to the sum
//         $sumBillTotal += $s->bill_total;
//     }

//     // Create an associative array to return both values
//     $result = [
//         'filteredSales' => $filteredSales,
//         'sumBillTotal' => $sumBillTotal,
//     ];

//     return $result;
// }



function getFilteredSales($customer_id = null, $start_date = null, $end_date = null)
{
    // Initialize the WHERE clause
    $whereClause = "s.sales_status = 'Active'";

    // Add conditions based on provided filters
    if ($customer_id !== null && $customer_id != -1) {
        $whereClause .= " AND s.Customer_id = $customer_id";
    }


    if ($start_date !== null && $end_date == '') {
        $whereClause .= " AND s.Sales_Date = '$start_date'";
    }

    if ($start_date !== null && $start_date !== '') {
        $whereClause .= " AND s.Sales_Date >= '$start_date'";
    }

    if ($end_date !== null && $end_date !== '') {
        $whereClause .= " AND s.Sales_Date <= '$end_date'";
    }

    $sql = "SELECT s.*, c.Customer_Name
            FROM `Sales` s
            JOIN `customer` c ON s.Customer_id = c.Customer_id
            WHERE $whereClause";

    $res = $this->db->query($sql);

    echo $sql;  // You might want to remove this line in a production environment

    $filteredSales = [];
    $sumBillTotal = 0; // Initialize sum variable

    while ($row = $res->fetch_assoc()) {
        $s = new Sales();

        $s->Sale_id = $row["Sale_id"];
        $s->Customer_id = $row["Customer_id"];
        $s->Customer_Name = $row["Customer_Name"];
        $s->sales_balance = $row["sales_balance"];
        $s->sales_paid_amount = $row["sales_paid_amount"];
        $s->Sales_Date = $row["Sales_Date"];
        $s->bill_total = $row["bill_total"];
        $s->sales_status = $row["sales_status"];
        $s->Sale_Timestamp = $row["Sale_Timestamp"];

        $filteredSales[] = $s;

        // Add each $s->bill_total to the sum
        $sumBillTotal += $s->bill_total;
    }

    // Create an associative array to return both values
    $result = [
        'filteredSales' => $filteredSales,
        'sumBillTotal' => $sumBillTotal,
    ];

    return $result;
}



// function getFilteredSales($customer_id = null, $start_date = null, $end_date = null)
// {
//     // Get all sales items sorted by quantity
//     $sqlSalesItems = "SELECT si.*, p.Product_Name
//                       FROM sales_items si
//                       JOIN products p ON si.Sales_Product_id = p.Product_id
//                       ORDER BY si.quantity DESC";

//     $resSalesItems = $this->db->query($sqlSalesItems);

//     $salesItems = [];
//     $highestSoldItem = null;

//     while ($row = $resSalesItems->fetch_array()) {
//         $item = new SalesItem();

//         $item->Item_id = $row["sale_item_id"];
//         $item->sale_id = $row["sale_id"];
//         $item->product_id = $row["Sales_Product_id"];
//         $item->Product_Name = $row["Product_Name"];
//         $item->Item_Quantity = $row["quantity"];
//         $item->Item_Price = $row["item_price"];
//         $item->Item_Discount = $row["discount"];
//         $item->Item_Amount = $row["item_amount"];

//         $salesItems[] = $item;

//         // Check if this item is the highest sold so far
//         if ($highestSoldItem === null || $item->Item_Quantity > $highestSoldItem->Item_Quantity) {
//             $highestSoldItem = $item;
//         }
//     }

//     // Get filtered sales data
//     $whereClause = "s.sales_status = 'Active'";

//     if ($customer_id !== null && $customer_id != -1) {
//         $whereClause .= " AND s.Customer_id = $customer_id";
//     }

//     if ($start_date !== null && $end_date == '') {
//         $whereClause .= " AND s.Sales_Date = '$start_date'";
//     }

//     if ($start_date !== null && $start_date !== '') {
//         $whereClause .= " AND s.Sales_Date >= '$start_date'";
//     }

//     if ($end_date !== null && $end_date !== '') {
//         $whereClause .= " AND s.Sales_Date <= '$end_date'";
//     }

//     $sqlFilteredSales = "SELECT s.*, c.Customer_Name
//                          FROM `Sales` s
//                          JOIN `customer` c ON s.Customer_id = c.Customer_id
//                          WHERE $whereClause";

//     $resFilteredSales = $this->db->query($sqlFilteredSales);

//     $filteredSales = [];
//     $sumBillTotal = 0; // Initialize sum variable

//     while ($row = $resFilteredSales->fetch_assoc()) {
//         $s = new Sales();

//         $s->Sale_id = $row["Sale_id"];
//         $s->Customer_id = $row["Customer_id"];
//         $s->Customer_Name = $row["Customer_Name"];
//         $s->sales_balance = $row["sales_balance"];
//         $s->sales_paid_amount = $row["sales_paid_amount"];
//         $s->Sales_Date = $row["Sales_Date"];
//         $s->bill_total = $row["bill_total"];
//         $s->sales_status = $row["sales_status"];
//         $s->Sale_Timestamp = $row["Sale_Timestamp"];

//         $filteredSales[] = $s;

//         // Add each $s->bill_total to the sum
//         $sumBillTotal += $s->bill_total;
//     }

//     // Create an associative array to return all values
//     $result = [
//         'salesItems' => $salesItems,
//         'highestSoldItem' => $highestSoldItem,
//         'filteredSales' => $filteredSales,
//         'sumBillTotal' => $sumBillTotal,
//     ];

//     return $result;
// }



// function getTotalQuantitySoldAndHighestSoldItem()
// {
//     $sql = "SELECT si.*, p.Product_Name
//             FROM sales_items si
//             JOIN products p ON si.Sales_Product_id = p.Product_id
//             ORDER BY si.quantity DESC"; // Sort in decreasing order based on quantity

//     $res = $this->db->query($sql);

//     $salesItems = [];
//     $highestSoldItem = null;
//     $totalQuantitySold = 0; // Initialize total quantity

//     while ($row = $res->fetch_assoc()) {
//         $item = new SalesItem();

//         $item->Item_id = $row["sale_item_id"];
//         $item->sale_id = $row["sale_id"];
//         $item->product_id = $row["Sales_Product_id"];
//         $item->Product_Name = $row["Product_Name"];
//         $item->Item_Quantity = $row["quantity"];
//         $item->Item_Price = $row["item_price"];
//         $item->Item_Discount = $row["discount"];
//         $item->Item_Amount = $row["item_amount"];

//         // Check if this item is the highest sold so far
//         if ($highestSoldItem === null || $item->Item_Quantity > $highestSoldItem->Item_Quantity) {
//             $highestSoldItem = $item;
//         }

//         // Accumulate total quantity sold
//         $totalQuantitySold += $item->Item_Quantity;

//         $salesItems[] = $item;
//     }

//     // Return both the sales items and the highest sold item
//     return [
//         'salesItems' => $salesItems,
//         'highestSoldItem' => $highestSoldItem,
//         'totalQuantitySold' => $totalQuantitySold,
//     ];
// }

function getQuantitySoldByProduct($productId)
{
    $sql = "SELECT SUM(si.quantity) AS total_quantity_sold
            FROM sales_items si
            WHERE si.Sales_Product_id = $productId";

    $res = $this->db->query($sql);
    $row = $res->fetch_assoc();

    return $row ? $row["total_quantity_sold"] : 0;
}

function getTotalQuantitySoldAndHighestSoldItem()
{
    $sql = "SELECT si.Sales_Product_id, p.Product_Name, SUM(si.quantity) AS total_quantity_sold
            FROM sales_items si
            JOIN products p ON si.Sales_Product_id = p.Product_id
            GROUP BY si.Sales_Product_id, p.Product_Name
            ORDER BY total_quantity_sold DESC"; // Sort in decreasing order based on total quantity sold

    $res = $this->db->query($sql);

    $salesItems = [];
    $highestSoldItem = null;
    $lowestSoldItem = null;

    while ($row = $res->fetch_assoc()) {
        $item = new SalesItem();

        // Only assign properties related to the item once
        $item->product_id = $row["Sales_Product_id"];
        $item->Product_Name = $row["Product_Name"];
        $item->Item_Quantity = $row["total_quantity_sold"];

        $salesItems[] = $item;

        // Check if this item is the highest sold or lowest sold so far
        if ($highestSoldItem === null || $item->Item_Quantity > $highestSoldItem->Item_Quantity) {
            $highestSoldItem = $item;
        }

        if ($lowestSoldItem === null || $item->Item_Quantity < $lowestSoldItem->Item_Quantity) {
            $lowestSoldItem = $item;
        }
    }

    // Return both the sales items, the highest sold item, and the lowest sold item
    return [
        'salesItems' => $salesItems,
        'highestSoldItem' => $highestSoldItem,
        'lowestSoldItem' => $lowestSoldItem,
    ];
}



}




    



