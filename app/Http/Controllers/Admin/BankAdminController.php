<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankAdmin;
use App\Models\BankUser;
use App\User;
use Illuminate\Http\Request;

class BankAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bankAdmin = BankAdmin::with( 'bank');
        $bankAdmin = $bankAdmin->paginate(10);

        return view('admin.bank_admin.list')->with([
            'bankAdmins' => $bankAdmin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();

        return view('admin.bank_admin.add')->with([
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
        $bankAdmin = new BankAdmin();
        $data = [
            'bank_no' => $request->bank_no,
            'acc_no' => $request->acc_no,
            'acc_name' => $request->acc_name,
            'created_at' => new \DateTime(),
        ];

        $bankAdmin->insert($data);

        return redirect(route('bank-admin.index'))->with(['success', "Thêm mới thành công"]);

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
        $bankAdmin = BankAdmin::with('bank')->where('id', $id)->first();
        $banks = Bank::all();

        return view('admin.bank_admin.edit')->with([
            'bankAdmin' => $bankAdmin,
            'banks' => $banks
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
        $bankAdmin =  BankAdmin::find($id);
        $bankAdmin->bank_no = $request->bank_no;
        $bankAdmin->acc_no = $request->acc_no;
        $bankAdmin->acc_name = $request->acc_name;
        $bankAdmin->save();

        return redirect(route('bank-admin.index'))->with(['success', "Cập nhật thành công"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bankAdmin = BankAdmin::find($id);
        $bankAdmin->destroy($id);
        return redirect(route('bank-admin.index'))->with(['success', "Cập nhật thành công"]);
    }
}
