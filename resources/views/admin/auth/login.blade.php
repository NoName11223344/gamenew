<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assset/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assset/css/login.css" rel="stylesheet">
    <script src="assset/js/jquery-1.11.1.min.js"></script>
    <script src="assset/js/bootstrap.min.js"></script>

</head>
<body>
<section class="login-block">
    <div class="container">
	<div class="row">
		<div class="login-sec">
		    <h2 class="text-center">Đăng nhập quản trị</h2>
            @if($errors->any())
                <p class="text-danger">{{$errors->first()}}</p>
            @endif
		    <form action="{{ route('post_login_admin') }}" class="login-form" method="POST">
            @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-uppercase">Tên đăng nhập</label>
                    <input name="user_name" type="text" class="form-control" placeholder="Tên đăng nhập">

                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Mật khẩu</label>
                    <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                </div>
                    <div class="form-check">
                    <button type="submit" class="btn btn-login float-right">Đăng nhập</button>
                </div>
            </form>
        </div>
		</div>
	</div>
</div>
</section>

</body>
</html>
