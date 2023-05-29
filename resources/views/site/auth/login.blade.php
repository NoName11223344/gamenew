<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assset/img/logo1.png') }}">
    <title>Đăng nhập</title>
    <link href="{{ asset('assset/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <script src="{{ asset('assset/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assset/js/bootstrap.min.js') }}"></script>

    <style>
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }
        body{
            background: url("{{ asset('assset/img/background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff
        }
        .card{
            background-color: #2415153d;
        }
    </style>
</head>
<body>
<section class="gradient-custom" style="height: 100vh">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body text-center">
                        <img src="{{ asset('assset/img/logo1.png') }}" width="250px" alt="">
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng nhập </h3>
                        <form method="post" action="{{ route('post_login') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="userName">Tên đăng nhập</label>
                                        <input type="text" id="userName" name="user_name" class="form-control" value="{{ old('user_name') ?? ''}}" placeholder="Tên đăng nhập"/>
                                        @error('user_name')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <input type="password" id="password" name="password" class="form-control"  placeholder="Mật khẩu"/>
                                        @error('password')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input class="btn btn-primary" type="submit" value="Đăng nhập" />
                                    <label for="">Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký tại đây</a></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('site.master.livechat')

</body>
</html>
