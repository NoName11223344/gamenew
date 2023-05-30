<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
    }
    public function getLogin(){
        if (!Auth::user()){
            return view('site.auth.login');
        }
        return redirect(route('dashboard'));
    }

    public function getLoginAdmin(){
        if (!Auth::user()){
            return view('admin.auth.login');
        }
        return redirect(route('statistical'));
    }

    public function postLogin(LoginRequest $request)
    {
        $user = User::where('user_name', $request->input('user_name'))->first();

        if ($user && Crypt::decrypt($user->password) === $request->input('password') && $user->status == 1) {
            Auth::login($user);
            return redirect(route('dashboard'));
        } else {
            return redirect()->back()->withErrors(['login' => 'Thông tin đăng nhập không chính xác']);
        }

        // Xác thực thất bại, quay trở lại trang đăng nhập với thông báo lỗi
    }

    public function postLoginAdmin(LoginRequest $request)
    {
        $user = User::where('user_name', $request->input('user_name'))->first();

        if ($user && Crypt::decrypt($user->password) === $request->input('password') && $user->status == 1 && in_array($user->role, ['1', '2'])) {
            Auth::login($user);
            return redirect(route('statistical'));
        } else {
            return redirect()->back()->withErrors(['login' => 'Thông tin đăng nhập không chính xác']);
        }

        // Xác thực thất bại, quay trở lại trang đăng nhập với thông báo lỗi
    }

    public function getRegister(Request $request)
    {
        return view('site.auth.register');
    }

    public function postRegister(UserRequest $request)
    {
        $userModel = new User();
        $data = [
            'user_name' => $request->user_name,
            'password' => Crypt::encrypt($request->password),
            'name' => $request->name,
            'phone' => $request->phone,
            'zalo' => $request->zalo,
            'rate' => $request->rate,
            'created_at' => new \DateTime(),
        ];
        if(isset($request->sale)){
            $sale = User::where('user_name', $request->sale)->first();
            $data['sale_id'] = $sale->id;
            $data['group_id'] = $sale->group_id;
        }

        $id = $userModel->insertGetId($data);

        return redirect(route('call_active'));
    }

    public function callActive(){
        return view('site.auth.call_active');
    }

    public function logOut()
    {
        Auth::logout();

        return redirect('/');
    }

    public function changePassword(UpdatePassword $request)
    {

        $user = Auth::user();

        if (Hash::check($request['old-pass'], $user->password)) {
            $this->userRepository->update($user->id, [
                'password' => $request['new-pass']
            ]);

            return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
        }

        return redirect()->back()->with('error', 'Mật khẩu cũ không đúng');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $data = [
            'name' => $request['name']
        ];

        $this->userRepository->update($user->id, $data);

        return redirect()->back()->with('success', 'Đổi Tên thành công');

    }
}
