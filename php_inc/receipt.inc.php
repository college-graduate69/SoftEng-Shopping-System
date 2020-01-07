<?php

class Receipt {
    private $db;

    function __construct($db) {
        $this->db = $db;
    }


    function completeTransaction($transactionId) {
        $status = 'complete';
        $stmt = $this->db->prepare("UPDATE transaction SET status = ? WHERE id = ?");
        $stmt->bind_param('si',$status, $transactionId);
        $stmt->execute();
        $stmt->close();
    }

}