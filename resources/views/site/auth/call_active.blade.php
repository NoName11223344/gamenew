<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assset/img/logo1.png') }}">
    <title>Đăng ký</title>
    <link href="{{ asset('assset/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <link href="{{ asset('assset/css/login.css') }}" rel="stylesheet">
    <script src="{{ asset('assset/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('assset/js/bootstrap.min.js') }}"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Mulish:wght@300;700&display=swap');

        * {
            box-sizing: border-box;
        }

        body {
            background-color: #fbfcfe;
            font-family: 'Mulish', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
            margin: 0;
        }

        .container {
            background-color: #fff;
            border: 3px black solid;
            border-radius: 10px;
            padding: 30px;
            max-width: 1000px;
            text-align: center;
        }

        .code-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 40px 0;
        }

        .code {
            border-radius: 5px;
            font-size: 75px;
            height: 120px;
            width: 100px;
            border: 1px solid #eee;
            margin: 1%;
            text-align: center;
            font-weight: 300;
            -moz-appearance: textfield;
        }

        .code::-webkit-outer-spin-button,
        .code::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .code:valid {
            border-color: #3498db;
            box-shadow: 0 10px 10px -5px rgba(0, 0, 0, 0.25);
        }

        .info {
            background-color: #eaeaea;
            display: inline-block;
            padding: 10px;
            line-height: 20px;
            max-width: 400px;
            color: #777;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .code-container {
                flex-wrap: wrap;
            }

            .code {
                font-size: 60px;
                height: 80px;
                max-width: 70px;
            }
        }

    </style>
    <script>
        const codes = document.querySelectorAll('.code');
        codes[0].focus();
        codes.forEach((code, idx) => {
            code.addEventListener('keydown', (e) => {
                if (e.key >= 0 && e.key <= 9) {
                    codes[idx].value = '';
                    setTimeout(() => codes[idx + 1].focus(), 10);
                } else if (e.key === 'Backspace') {
                    setTimeout(() => codes[idx - 1].focus(), 10);
                }
            });
        });
    </script>
</head>
<body>
<section class="vh-100 gradient-custom">
    <div class="container">
        <h2>Liên hệ với chúng tôi để được kích hoạt tài khoản.</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Kênh</th>
                <th scope="col">Liên hệ</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Số điện thoại</td>
                <td>{{$information['so-dien-thoai']}}</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Telegram</td>
                <td><a href="{{$information['telegram']}}">{{$information['telegram']}}</a></td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Zalo</td>
                <td><a href="https://zalo.me/{{$information['zalo']}}">{{$information['zalo']}}</a></td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Chat ngay cho chúng tôi</td>
                <td>CHAT</td>
            </tr>
            </tbody>
        </table>
        <div class="text-center">
            <a href="{{ route('get_login') }}" class="btn btn-info">Về trang đăng nhập</a>
        </div>
    </div>
</section>
@include('site.master.livechat')

</body>
</html>
