<?php

namespace App\Business;

use App\Models\Transaction;

class TransactionBusiness
{
    public $transactionModel;
    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function getWithUserId($id){
        $trans = $this->transactionModel->where('user_id', $id)
            ->orderBy('request_time', "DESC")
            ->paginate(10);

        return $trans;
    }
}
