<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RevenueController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $user = Auth::user();
                $this->user = $user;
            }
            return $next($request);
        });

    }
    public function index(Request $request){
        if ($this->user->role == User::ROLE_SALE){
            return $this->indexForSale($request);
        }

        $groups = Group::orderBy('id', 'ASC');
        $users = User::with('group')->where('role', 2);
        if ($request->sale_id){
            $users = $users->where('id', $request->sale_id);
        }
        if ($request->group_id){
            $users = $users->where('group_id', $request->group_id);

            $arrUser = json_decode(json_encode($users->pluck('id')),true);
        }
        $users = $users->get();
        $groups = $groups->get();
        $data = [];

        $trans = new Transaction();
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[1])));
            $trans = $trans->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        if ($request->group_id){
            $trans = $trans->whereIn('sale_id', $arrUser);
        }
        $trans = $trans->where('status', 1);
        $totalTopupAll = $trans->where('type', 0)->count();
        $sumTopupAll = $trans->where('type', 0)->sum('amount');

        $trans = new Transaction();
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[1])));
            $trans = $trans->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        $trans = $trans->where('status', 1);
        $totalWithdrawAll = $trans->where('type', 1)->count();
        $sumWithdrawAll = $trans->where('type', 1)->sum('amount');
        $revenueAll = $sumTopupAll - $sumWithdrawAll ;

        foreach ($users as $item){
            $transactions = Transaction::where('sale_id', $item->id)->where('status', 1);
            if ($request->time_range){
                $timeArr = explode('-', $request->time_range);
                $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
                $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[1])));
                $transactions = $transactions->where('request_time', '>=', $timeStart)
                    ->where('request_time', '<=', $timeEnd);
            }
            $transactions = $transactions->get();

            $totalTopup = 0;
            $sumTopup = 0;
            $totalWithdraw = 0;
            $sumWithdraw = 0;
            foreach ($transactions as $tran){
                if ($tran->type == 0){
                    $totalTopup += 1;
                    $sumTopup += $tran->amount;
                } elseif ($tran->type == 1){
                    $totalWithdraw += 1;
                    $sumWithdraw += $tran->amount;
                }
            }

            $data[$item->id]['user_name'] = $item->user_name;
            $data[$item->id]['group'] = isset($item->group->group_name) ? $item->group->group_name : '';
            $data[$item->id]['name'] = $item->name;
            $data[$item->id]['total_topup'] = $totalTopup;
            $data[$item->id]['sum_topup'] = $sumTopup;
            $data[$item->id]['total_withdraw'] = $totalWithdraw;
            $data[$item->id]['sum_withdraw'] = $sumWithdraw;
            $data[$item->id]['revenue'] = $sumTopup - $sumWithdraw;
        }
        $data = json_decode(json_encode($data));

        $transactionsNoSale = Transaction::where('sale_id', null)->where('status', 1);
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[1])));
            $transactionsNoSale = $transactionsNoSale->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        $transactionsNoSale = $transactionsNoSale->get();

        $totalTopupNoSale = 0;
        $sumTopupNoSale = 0;
        $totalWithdrawNoSale = 0;
        $sumWithdrawNoSale = 0;
        foreach ($transactionsNoSale as $tran){
            if ($tran->type == 0){
                $totalTopupNoSale += 1;
                $sumTopupNoSale += $tran->amount;
            } elseif ($tran->type == 1){
                $totalWithdrawNoSale += 1;
                $sumWithdrawNoSale += $tran->amount;
            }
        }
        $dataNoSale = [];
        $dataNoSale['user_name'] = 'Không có sale';
        $dataNoSale['group'] = "Không Phân đại lý";
        $dataNoSale['name'] = 'Không có sale';
        $dataNoSale['total_topup'] = $totalTopupNoSale;
        $dataNoSale['sum_topup'] = $sumTopupNoSale;
        $dataNoSale['total_withdraw'] = $totalWithdrawNoSale;
        $dataNoSale['sum_withdraw'] = $sumWithdrawNoSale;
        $dataNoSale['revenue'] = $sumTopupNoSale - $sumWithdrawNoSale;

        return view('admin.revenue.list')->with([
            'revenues' => $data,
            'groups' => $groups,
            'sales' => $users,
            'totalTopupAll' => $totalTopupAll ,
            'sumTopupAll' => $sumTopupAll,
            'totalWithdrawAll' => $totalWithdrawAll,
            'sumWithdrawAll' => $sumWithdrawAll,
            'revenueAll' => $revenueAll,
            'dataNoSale' => $dataNoSale,
        ]);
    }

    public function indexForSale(Request $request){
        $user = $this->user;
        $transactions = Transaction::where('sale_id', $user->id)->where('status', 1);
        if ($request->time_range){
            $timeArr = explode('-', $request->time_range);
            $timeStart = date('Y-m-d 00:00:00', strtotime(trim($timeArr[0])));
            $timeEnd =  date('Y-m-d 23:59:59', strtotime(trim($timeArr[1])));
            $transactions = $transactions->where('request_time', '>=', $timeStart)
                ->where('request_time', '<=', $timeEnd);
        }
        $transactions = $transactions->get();

        $totalTopup = 0;
        $sumTopup = 0;
        $totalWithdraw = 0;
        $sumWithdraw = 0;
        foreach ($transactions as $tran){
            if ($tran->type == 0){
                $totalTopup += 1;
                $sumTopup += $tran->amount;
            } elseif ($tran->type == 1){
                $totalWithdraw += 1;
                $sumWithdraw += $tran->amount;
            }
        }

        $data[$user->id]['user_name'] = $user->user_name;
        $data[$user->id]['group'] = isset($user->group->group_name) ? $user->group->group_name : null;
        $data[$user->id]['name'] = $user->name;
        $data[$user->id]['total_topup'] = $totalTopup;
        $data[$user->id]['sum_topup'] = $sumTopup;
        $data[$user->id]['total_withdraw'] = $totalWithdraw;
        $data[$user->id]['sum_withdraw'] = $sumWithdraw;
        $data[$user->id]['revenue'] = $sumTopup - $sumWithdraw;

        $data = json_decode(json_encode($data));

        return view('admin.revenue.list_for_sale')->with([
            'revenues' => $data,
        ]);
    }

}
