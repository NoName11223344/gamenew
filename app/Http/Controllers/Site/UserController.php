<?php

namespace App\Http\Controllers\Site;

use App\Business\UserBusiness;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankAccRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Bank;
use App\Models\BankUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class UserController extends Controller
{
    public $userBusiness;
    public function __construct()
    {
        $this->userBusiness = new UserBusiness();
    }

    public function index(){
        $user = Auth::user();
        $bankUser = BankUser::where('user_id', $user->id)->first();
        $banks = Bank::get();
        return view('site.dashboard')->with([
            'user' => $user,
            'bankUser' => $bankUser,
            'banks' => $banks
        ]);
    }

    public function update(UserUpdateRequest $request){
        $user = User::where('id', Auth::user()->id)->first();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->rate = $request->rate;

        $user->save();

        return redirect()->back();

    }

    public function updateBankAccount(BankAccRequest $request){
        $user = Auth::user();
        $bankUser = BankUser::where('user_id', $user->id)->first();
        if ($bankUser){
            $bankUser->acc_name = $request->acc_name;
            $bankUser->bank_no = $request->bank_no;
            $bankUser->acc_no = $request->acc_no;
            $bankUser->save();
        }else{
            $data = [
                'acc_name' => $request->acc_name,
                'user_id' => $user->id,
                'bank_no' => $request->bank_no,
                'acc_no' => $request->acc_no,
                'created_at' => new \DateTime(),
            ];
            BankUser::insertGetId($data);
        }
        return redirect()->back()->with('message', 'Cập nhật thành công!');
    }
}
