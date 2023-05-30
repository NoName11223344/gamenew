<a href="{{ isset($information->telegram) ? $information->telegram : 'telegram.com' }}" class="float">
    <img src="{{ asset('assset/img/telegram_logo.svg') }}" alt="">
</a>
<style>
    .float:hover{
        color:#FFF;
    }
    .float{

        position:fixed;
        width:60px;
        height:60px;
        bottom:40px;
        right:40px;
        background-color:#0C9;
        color:#FFF;
        border-radius:50px;
        text-align:center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float{
        margin-top:22px;
    }
</style>
