<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAdmin extends Model
{
    public $table = 'bank_admin';
    protected $primaryKey = "id";

    public function bank(){
        return $this->hasOne(Bank::class, 'bank_no', 'bank_no');
    }
}
