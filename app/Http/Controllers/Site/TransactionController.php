<?php

namespace App\Http\Controllers\Site;

use App\Business\TransactionBusiness;
use App\Helper\CommonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopupRequest;
use App\Http\Requests\WithdrawRequest;
use App\Models\Bank;
use App\Models\BankAdmin;
use App\Models\BankUser;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public $transactionBusiness;
    public function __construct()
    {
        $this->transactionBusiness = new TransactionBusiness();
    }

    public function index(Request $request){
        $id = Auth::user()->id;
        $trans = $this->transactionBusiness->getWithUserId($id);

        return view('site.transactions')->with([
            'transactions' => $trans
        ]);
    }

    public function topup(){
        $bank = BankAdmin::all();
        $user = Auth::user();
        return view('site.topup')->with([
            'banks' => $bank,
            'user' => $user
        ]);
    }

    public function postTopup(TopupRequest $request){

        $bankAdmin = BankAdmin::where('acc_no', $request->acc_no)->first();
        $data = [
            'trans_id' => CommonHelper::generateTransId(),
            'bank_no' => $bankAdmin->bank_no,
            'acc_no' => $bankAdmin->acc_no,
            'memo' => $request->memo,
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'agency_id' => isset(Auth::user()->agency_id) ? Auth::user()->agency_id : null ,
            'type' => '0',
            'request_time' => new \DateTime(),
            'created_at' => new \DateTime(),
            'promotion_code' => isset($request->promotion_code) ? $request->promotion_code : null,
        ];

        $save = Transaction::insert($data);

        return redirect()->route('show_bank_account', ['trans_id' => $data['trans_id']]);
    }

    public function showBankAccount($transId){
        $trans = Transaction::with('bank')->where('trans_id', $transId)->first();
        return view('site.bank_list_topup')->with([
            'trans' => $trans
        ]);
    }

    public function withdraw(){
        $bankUser = BankUser::with('bank')->where('user_id', Auth::user()->id)
            ->first();
        return view('site.withdraw')->with([
            'bankUser' => $bankUser
        ]);
    }

    public function postWithdraw(WithdrawRequest $request){
        $bankUser = BankUser::where('user_id', Auth::user()->id)->first();
        $data = [
            'trans_id' => CommonHelper::generateTransId(),
            'acc_no' => $bankUser->acc_no,
            'bank_no' => $bankUser->bank_no,
            'amount' => $request->amount,
            'user_id' => Auth::user()->id,
            'type' => '1',
            'agency_id' => isset(Auth::user()->agency_id) ? Auth::user()->agency_id : null ,
            'request_time' => new \DateTime(),
            'created_at' => new \DateTime(),
            'promotion_code' => isset($request->promotion_code) ? $request->promotion_code : null,
        ];

        $save = Transaction::insert($data);
        return redirect()->route('transactions')->with([
            'success' => 'Yêu cầu rút tiền đã được ghi nhận.'
        ]);
    }

}
