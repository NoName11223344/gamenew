<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $table = 'transactions';
    protected $primaryKey = "trans_id";

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bank(){
        return $this->hasOne(Bank::class, 'bank_no', 'bank_no');
    }

    public function bankAdmin(){
        return $this->hasOne(BankAdmin::class, 'acc_no', 'acc_no');
    }
}
