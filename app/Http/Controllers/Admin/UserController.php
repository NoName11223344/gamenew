<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Group;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('sale')->orderBy('id', 'DESC');
        if ($request->user_name){
            $users = $users->where('user_name', $request->user_name);
        }
        if (isset($request->status)){
            $users = $users->where('status', $request->status);
        }
        if (isset($request->role)){
            $users = $users->where('role', $request->role);
        }
        if ($this->user->role == User::ROLE_SALE){
            $users = $users->where('sale_id', $this->user->id);
        }
        $users = $users->paginate(10);

        return view('admin.user.list')->with([
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
        $usersSale = User::with('group')->where('role', '2')->get();
        $groups = Group::get();

        return view('admin.user.add')->with([
            'sales' => $usersSale,
            'groups' => $groups
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
           $userModel = new User();
            $data = [
                'user_name' => $request->user_name,
                'password' => Crypt::encrypt($request->password),
                'name' => $request->name,
                'phone' => $request->phone,
                'rate' => $request->rate,
                'role' => $request->role,
                'sale_id' => $request->sale_id,
                'group_id' => $request->group_id,
                'created_at' => new \DateTime(),
            ];

            $id = $userModel->insertGetId($data);

            return redirect(route('user.index'))->with(['success', "Thêm mới thành công"]);
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
        $user = User::with('sale', 'group')->find($id);
        $usersSale = User::with('group')->where('role', '2')->get();
        $groups = Group::get();

        return view('admin.user.edit')->with([
            'user' => $user,
            'sales' => $usersSale,
            'groups' => $groups,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id);
        $user->user_name = $request->user_name;
        $user->name = $request->name;
        $user->password = Crypt::encrypt($request->password);
        $user->phone = $request->phone;
        $user->rate = $request->rate;
        $user->role = $request->role;
        $user->sale_id = $request->sale_id;
        $user->group_id = $request->group_id;
        $user->save();

        return redirect(route('user.index'))->with(['success', "Cập nhật thành công"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->destroy($id);
        return redirect(route('user.index'))->with(['success', "Cập nhật thành công"]);

    }

    public function accept($id)
    {
        $user = User::find($id);
        $user->status = $user->status == 0 ? '1' : 0;
        $user->save();
        return redirect(route('user.index'))->with(['success', "Cập nhật thành công"]);
    }
}
