<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    public function index(){
        $users = User::get();
        $transactions = Transaction::get();
        $countToday = User::whereDate('created_at', date('Y-m-d'))
            ->count();
        $userNeedActive = 0;
        $userActive = 0;
        $transactionNeedConfirm = 0;
        $transactionConfirm = 0;
        $transactionDeposit = 0;
        $transactionWithdraw = 0;
        $transTopupNeedActive = 0;
        $transWithdrawNeedActive = 0;

        foreach ($users as $user){
            if ($user->status == 0){
                $userNeedActive +=1;
            }
            if ($user->status == 1){
                $userActive +=1;
            }
        }
        foreach ($transactions as $trans){
            if ($trans->status == 0){
                $transactionNeedConfirm +=1;
                if ($trans->type == 0){
                    $transTopupNeedActive +=1;
                }elseif($trans->type == 1){
                    $transWithdrawNeedActive +=1;
                }
            }
            if ($trans->status == 1){
                $transactionConfirm +=1;
            }
            if ($trans->type == 0){
                $transactionDeposit +=1;
            }
            if ($trans->type == 1){
                $transactionWithdraw +=1;
            }
        }

        return view('admin.top')->with([
            'userNeedActive' => $userNeedActive,
            'userActive' => $userActive,
            'totalUser' => count($users),
            'countUserToday' => $countToday,
            'transactionNeedConfirm' => $transactionNeedConfirm,
            'transactionConfirm' => $transactionConfirm,
            'transactionDeposit' => $transactionDeposit,
            'transactionWithdraw' => $transactionWithdraw,
            'transTopupNeedActive' => $transTopupNeedActive,
            'transWithdrawNeedActive' => $transWithdrawNeedActive,
        ]);
    }
}
