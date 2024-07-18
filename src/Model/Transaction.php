<?php
namespace App\Model;

class Transaction {
    private $type;
    private $amount;
    private $date;
    private $description;

    public function __construct($type, $amount, $date, $description) {
        $this->type = $type;
        $this->amount = $amount;
        $this->date = $date;
        $this->description = $description;
    }

    public function save() {
        // Save the transaction to the database
    }
}