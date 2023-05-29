<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankUser;
use App\Models\Information;
use App\User;
use Illuminate\Http\Request;

class BankUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bankUsers = BankUser::with('user', 'bank');
        if ($request->user_id){
            $bankUsers = $bankUsers->where('user_id', $request->user_id);
        }
        $bankUsers = $bankUsers->paginate(10);
        $users = User::all();

        return view('admin.bank_user.list')->with([
            'bankUsers' => $bankUsers,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $banks = Bank::all();

        return view('admin.bank_user.add')->with([
            'users' => $users,
            'banks' => $banks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bankUser = new BankUser();
        $checkBankUserExist =  BankUser::find($request->user_id);
        if ($checkBankUserExist){
            return redirect()->back()->withErrors('Người dùng này đã được cấu hình tài khoản');
        }
        $data = [
            'user_id' => $request->user_id,
            'bank_no' => $request->bank_no,
            'acc_no' => $request->acc_no,
            'acc_name' => $request->acc_name,
            'status' => 1,
            'created_at' => new \DateTime(),
        ];

        $bankUser->insert($data);

        return redirect(route('bank-user.index'))->with(['success', "Thêm mới thành công"]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankUser = BankUser::find($id);
        $users = User::all();
        $banks = Bank::all();

        return view('admin.bank_user.edit')->with([
            'users' => $users,
            'banks' => $banks,
            'bankUser' => $bankUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bankUser =  BankUser::find($id);
        $bankUser->bank_no = $request->bank_no;
        $bankUser->acc_no = $request->acc_no;
        $bankUser->acc_name = $request->acc_name;
        $bankUser->save();

        return redirect(route('bank-user.index'))->with(['success', "Cập nhật thành công"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankUser = BankUser::find($id);
        $bankUser->destroy($id);
        return redirect(route('bank-user.index'))->with(['success', "Cập nhật thành công"]);
    }
}
