<?php

namespace App;

use App\Models\Group;
use App\Models\Transaction;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function getAuthPassword()
    {
        return Crypt::decrypt($this->attributes['password']);
    }

    public function sale(){
        return $this->hasOne(User::class, 'id', 'agency_id');
    }

    public function group(){
        return $this->hasOne(Group::class, 'id', 'agency_id');
    }


    public function transactionInCharge(){
        return $this->hasMany(Transaction::class, 'id', 'agency_id');
    }
}
