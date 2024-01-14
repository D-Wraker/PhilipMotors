<?php

include_once "../config.php";

class Payment
{
    public $payment_id;
    public $transaction_type;
    public $transaction_id;
    public $payment_amount;
    public $payment_date;
    public $payment_method;
    public $payment_status;

    private $db;

    function __construct()
    {
        $this->db = new mysqli(host, un, password, db);
    }

    function insert_payment()
    {
        $sql = "INSERT INTO payment (transaction_type, transaction_id, payment_amount,  payment_status)
                VALUES ('$this->transaction_type', '$this->transaction_id', '$this->payment_amount', '$this->payment_status')";

        // echo $sql;
        $this->db->query($sql);
        $payment_id = $this->db->insert_id;

        return $payment_id;
    }


    public function get_payment_history($sale_id)
    {
        $sql = "SELECT payment_amount, payment_date
                FROM payment
                WHERE transaction_type = 'sales' AND transaction_id = $sale_id
                ORDER BY payment_date DESC";

        $result = $this->db->query($sql);

        $payment_history = [];

        while ($row = $result->fetch_assoc()) {
            $payment = new stdClass();
            $payment->payment_amount = $row['payment_amount'];
            $payment->payment_date = $row['payment_date'];

            $payment_history[] = $payment;
        }

        return $payment_history;
    }

    // -----------------------------------------------------
    public function get_purchase_payment_history($purchase_id)
    {
        $sql = "SELECT payment_amount, payment_date
                FROM payment
                WHERE transaction_type = 'purchase' AND transaction_id = $purchase_id
                ORDER BY payment_date DESC";

        $result = $this->db->query($sql);

        $purchase_payment_history = [];

        while ($row = $result->fetch_assoc()) {
            $payment = new stdClass();
            $payment->payment_amount = $row['payment_amount'];
            $payment->payment_date = $row['payment_date'];

            $purchase_payment_history[] = $payment;
        }

        return $purchase_payment_history;
    }
}
