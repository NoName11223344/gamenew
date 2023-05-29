<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankUser;
use App\User;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::orderBy('bank_id', "DESC")->get();

        return view('admin.bank.list')->with([
            'banks' => $banks,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'bank_no' => $request->bank_no,
            'bank_name' => $request->bank_name,
            'bank_short_name' => $request->bank_short_name,
            'status' => 1,
            'created_at' => new \DateTime(),
        ];

        Bank::insert($data);

        return redirect(route('bank.index'))->with(['success', "Thêm mới thành công"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);

        return view('admin.bank.edit')->with([
            'bank' => $bank
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
        $bank = Bank::find($id);
        $bank->bank_no = $request->bank_no;
        $bank->bank_name = $request->bank_name;
        $bank->bank_short_name = $request->bank_short_name;
        $bank->save();

        return redirect(route('bank.index'))->with(['success', "Cập nhật thành công"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->destroy($id);
        return redirect(route('bank.index'))->with(['success', "Cập nhật thành công"]);
    }
}
