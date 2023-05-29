<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankUserController extends Controller
{
    public function showBankUser(){
        $userId = Auth::user()->id;
        $bankUser = BankUser::where('user_id', $userId)->first();
        $banks = Bank::get();

        return view('site.bank_user')->with([
            'bankUser' => $bankUser,
            'banks' => $banks,
        ]);
    }
}
