<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assset/img/logo1.png') }}">
    <title>Đăng ký</title>
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

        body{
            background: url("{{ asset('assset/img/background.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff
        }
        .card{
            background-color: #2415153d;
        }

        .card-registration .select-arrow {
            top: 13px;
        }
    </style>
</head>
<body>
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body text-center">
                        <img src="{{ asset('assset/img/logo1.png') }}" width="250px" alt="">
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Đăng ký </h3>
                        <form method="post" id="form-register" action="{{ route('post_register') }}">
                            @csrf
                            <input type="hidden" name="sale" value="{{ request('sale') }}">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="userName">Tên đăng nhập</label><span>*</span>
                                        <input type="text" id="userName" name="user_name"
                                               class="form-control" value="{{ old('user_name') ?? ''}}"
                                                placeholder="Tên đăng nhập"/>
                                        @error('user_name')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="password">Mật khẩu</label><span>*</span>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="8-15 ký tự, ít nhất 2 chữ cái 1 chữ viết HOA và số" />
                                        @error('password')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="password_confirmation">Nhập lại Mật khẩu</label><span>*</span>
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               class="form-control" placeholder="Nhập lại mật khẩu"/>
                                        @error('password_confirmation')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="name">Họ tên(Lưu ý: nhập đúng với tên tài khoản ngân hàng)</label><span>*</span>
                                        <input type="text" id="name" name="name" class="form-control"  value="{{ old('name') ?? '' }}" placeholder="Họ tên(Lưu ý: nhập đúng với tên tài khoản ngân hàng)"/>
                                        @error('name')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="phone">Số điện thoại</label><span>*</span>
                                        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') ?? '' }}" placeholder="Số điện thoại" />
                                        @error('phone')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="zalo">Số zalo</label><span>*</span>
                                        <input type="text" id="zalo" name="zalo" class="form-control" value="{{ old('zalo') ?? '' }}" placeholder="Số zalo" />
                                        @error('zalo')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <div class="form-outline">
                                        <label class="form-label" for="name">Mức quy đổi </label><span>*</span>
                                        <select class="select form-control select2" name="rate">
                                            <option value="1" @if (old('rate') && old('rate') == 1 )selected @endif>1đ = 25.000đ</option>
                                            <option value="2" @if (old('rate') && old('rate') == 2 )selected @endif>1đ = 50.000đ</option>
                                            <option value="3" @if (old('rate') && old('rate') == 3 )selected @endif>1đ = 100.000đ</option>
                                        </select>
                                        @error('rate')
                                        <p class="text-white-50"><i>{{ $message }}</i></p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <section>
                                        <fieldset>
                                            <input type="text" id="UserCaptchaCode" class="CaptchaTxtField form-control" placeholder='Nhập Captcha - Phân biệt chữ hoa chữ thường'>
                                            <span id="WrongCaptchaError" class="text-white-50"></span>
                                            <div class='CaptchaWrap'>
                                                <div id="CaptchaImageCode" class="CaptchaTxtField">
                                                    <canvas id="CapCode" class="capcode" width="300" height="80"></canvas>
                                                </div>
                                                <input type="button" class="ReloadBtn" onclick='CreateCaptcha();'>
                                            </div>
                                        </fieldset>
                                    </section>
                                </div>
                                <div class="col-md-12">
                                    <input class="btn btn-primary"  onclick="CheckCaptcha();" value="Đăng ký" />
                                    <label for="">Đã có tài khoản<a href="{{ route('get_login') }}">Đăng nhập tại đây</a></label>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('site.master.livechat')

    <style>
        .CaptchaWrap { position: relative; }
        .CaptchaTxtField {
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
            box-sizing: border-box;
        }


        #CaptchaImageCode {
            text-align:center;
            margin-top: 15px;
            padding: 0px 0;
            width: 200px;
            overflow: hidden;
        }

        .capcode {
            width: 100%;
            font-size: 46px;
            display: block;
            -moz-user-select: none;
            -webkit-user-select: none;
            user-select: none;
            cursor: default;
            letter-spacing: 1px;
            color: #ccc;
            font-family: 'Roboto Slab', serif;
            font-weight: 100;
            font-style: italic;
        }

        .ReloadBtn {
            background:url('https://cdn3.iconfinder.com/data/icons/basic-interface/100/update-64.png') left top no-repeat;
            background-size : 100%;
            width: 32px;
            height: 32px;
            border: 0px;
            outline: none;
            position: absolute;
            bottom: 15%;
            left: 90%;
            background-color: #fff;
            outline: none;
            cursor: pointer; /**/
        }
        .btnSubmit {
            margin-top: 15px;
            border: 0px;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 18px;
            background-color: #1285c4;
            color: #fff;
            cursor: pointer;
        }

        .error {
            color: red;
            font-size: 12px;
            display: none;
        }
        .success {
            color: green;
            font-size: 18px;
            margin-bottom: 15px;
            display: none;
        }
    </style>
    <script>
        var cd;

        $(function(){
            CreateCaptcha();
        });

        // Create Captcha
        function CreateCaptcha() {
            //$('#InvalidCapthcaError').hide();
            var alpha = new Array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');

            var i;
            for (i = 0; i < 6; i++) {
                var a = alpha[Math.floor(Math.random() * alpha.length)];
                var b = alpha[Math.floor(Math.random() * alpha.length)];
                var c = alpha[Math.floor(Math.random() * alpha.length)];
                var d = alpha[Math.floor(Math.random() * alpha.length)];
                var e = alpha[Math.floor(Math.random() * alpha.length)];
                var f = alpha[Math.floor(Math.random() * alpha.length)];
            }
            cd = a + ' ' + b + ' ' + c + ' ' + d + ' ' + e + ' ' + f;
            $('#CaptchaImageCode').empty().append('<canvas id="CapCode" class="capcode" width="300" height="80"></canvas>')

            var c = document.getElementById("CapCode"),
                ctx=c.getContext("2d"),
                x = c.width / 2,
                img = new Image();

            img.src = "https://pixelsharing.files.wordpress.com/2010/11/salvage-tileable-and-seamless-pattern.jpg";
            img.onload = function () {
                var pattern = ctx.createPattern(img, "repeat");
                ctx.fillStyle = pattern;
                ctx.fillRect(0, 0, c.width, c.height);
                ctx.font="46px Roboto Slab";
                ctx.fillStyle = '#ccc';
                ctx.textAlign = 'center';
                ctx.setTransform (1, -0.12, 0, 1, 0, 15);
                ctx.fillText(cd,x,55);
            };


        }

        // Validate Captcha
        function ValidateCaptcha() {
            var string1 = removeSpaces(cd);
            var string2 = removeSpaces($('#UserCaptchaCode').val());
            if (string1 == string2) {
                return true;
            }
            else {
                return false;
            }
        }

        // Remove Spaces
        function removeSpaces(string) {
            return string.split(' ').join('');
        }

        // Check Captcha
        function CheckCaptcha() {
            var result = ValidateCaptcha();
            if( $("#UserCaptchaCode").val() == "" || $("#UserCaptchaCode").val() == null || $("#UserCaptchaCode").val() == "undefined") {
                $('#WrongCaptchaError').text('Nhập Captcha - Phân biệt chữ hoa chữ thường').show();
                $('#UserCaptchaCode').focus();
            } else {
                if(result == false) {
                    $('#WrongCaptchaError').text('Captcha xác thực không hợp lệ! Vui lòng thử lại.').show();
                    CreateCaptcha();
                    $('#UserCaptchaCode').focus().select();
                }
                else {
                    $('#form-register').submit();
                    $('#UserCaptchaCode').val('').attr('place-holder','Nhập Captcha - Phân biệt chữ hoa chữ thường');
                    CreateCaptcha();
                    // $('#WrongCaptchaError').fadeOut(100);
                    // $('#SuccessMessage').fadeIn(500).css('display','block').delay(5000).fadeOut(250);
                }
            }
        }
    </script>
</section>
</body>
</html>
