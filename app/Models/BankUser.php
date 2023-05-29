<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BankUser extends Model
{
    public $table = 'bank_user';

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bank(){
        return $this->hasOne(Bank::class, 'bank_no', 'bank_no');
    }
}
