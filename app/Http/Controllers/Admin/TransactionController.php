<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::with('user');
        if ($request->user_name){
            $user = User::where('user_name', $request->user_name)->first();
            $transactions = $transactions->where('user_id', $user->id);
        }
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[1])));
            $transactions = $transactions->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        if (isset($request->status)){
            $transactions = $transactions->where('status', $request->status);
        }
        if (isset($request->type)){
            $transactions = $transactions->where('type', $request->type);
        }
        $transactions = $transactions->orderBy('request_time', 'DESC')
            ->paginate(10);

        return view('admin.transaction.index')->with([
            'transactions' => $transactions
        ]);
    }

    public function topup(Request $request)
    {
        $transactions = Transaction::with('user')->where('type', 0)->where('status', "!=", 2);
        if ($request->user_name){
            $user = User::where('user_name', $request->user_name)->first();
            $transactions = $transactions->where('user_id', $user->id);
        }
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[0])));
            $transactions = $transactions->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        if (isset($request->status)){
            $transactions = $transactions->where('status', $request->status);
        }
        if (isset($request->type)){
            $transactions = $transactions->where('type', $request->type);
        }
        $totalTrans = $transactions->count();
        $sumTransAmount = $transactions->sum('amount');

        $transactions = $transactions->orderBy('request_time', 'DESC')
            ->paginate(10);

        return view('admin.transaction.topup')->with([
            'transactions' => $transactions,
            'totalTrans' => $totalTrans,
            'sumTransAmount' => $sumTransAmount,
        ]);
    }

    public function withdraw(Request $request)
    {
        $transactions = Transaction::with('user')->where('type', 1)->where('status', "!=", 2);

        if ($request->user_name){
            $user = User::where('user_name', $request->user_name)->first();
            $transactions = $transactions->where('user_id', $user->id);
        }
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[0])));
            $transactions = $transactions->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        if (isset($request->status)){
            $transactions = $transactions->where('status', $request->status);
        }

        $totalTrans = $transactions->count();
        $sumTransAmount = $transactions->sum('amount');

        $transactions = $transactions->orderBy('request_time', 'DESC')
            ->paginate(10);

        return view('admin.transaction.withdraw')->with([
            'transactions' => $transactions,
            'totalTrans' => $totalTrans,
            'sumTransAmount' => $sumTransAmount,
        ]);
    }

    public function pending(Request $request)
    {
        $transactions = Transaction::with('user')->where('status', 0);

        if ($request->user_name){
            $user = User::where('user_name', $request->user_name)->first();
            $transactions = $transactions->where('user_id', $user->id);
        }
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[0])));
            $transactions = $transactions->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        if (isset($request->status)){
            $transactions = $transactions->where('status', $request->status);
        }

        $totalTrans = $transactions->count();
        $sumTransAmount = $transactions->sum('amount');

        $transactions = $transactions->orderBy('request_time', 'DESC')
            ->paginate(10);

        return view('admin.transaction.pending')->with([
            'transactions' => $transactions,
            'totalTrans' => $totalTrans,
            'sumTransAmount' => $sumTransAmount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trans = Transaction::where('trans_id', $id)->first();
        $trans->destroy($id);
        return redirect()->back()->with(['success', "Cập nhật thành công"]);

    }

    public function accept($id)
    {
        $trans = Transaction::where('trans_id', $id)->first();
        $trans->status = $trans->status == 0 ? '1' : 0;
        $trans->update_end_status_at = new \DateTime();
        $trans->save();

        return redirect()->back()->with(['success', "Cập nhật thành công"]);
    }

    public function cancel($id)
    {
        $trans = Transaction::where('trans_id', $id)->first();
        $trans->status = 2;
        $trans->update_end_status_at = new \DateTime();
        $trans->save();

        return redirect(route('transaction.index'))->with(['success', "Cập nhật thành công"]);
    }

    public function cancelModal(Request $request){
        $id = $request->trans_id;
        $trans = Transaction::where('trans_id', $id)->first();
        $trans->status = 2;
        $trans->note = isset($request->note) ? $request->note : null;
        $trans->update_end_status_at = new \DateTime();
        $trans->save();

        return redirect()->back()->with(['success', "Cập nhật thành công"]);
    }
}
