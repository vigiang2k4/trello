@extends('account.master')

@section('title')
    Quên mật khẩu
@endsection

@section('content')
    <form class="login100-form validate-form" action="{{ route('forgot_') }}" method="POST">
        @csrf
        
        <span class="login100-form-title p-b-49">
            Quên mật khẩu
        </span>

        <div class="wrap-input100 validate-input m-b-23" data-validate="Vui lòng nhập email">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="email" placeholder="Nhập email của bạn">
            <span class="focus-input100" data-symbol="&#xf1fa;"></span>
        </div>

        <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn">
                    Đặt lại mật khẩu
                </button>
            </div>
        </div>

        <div class="text-center p-t-8 p-b-31 mt-3">
            <a href="{{ route('login') }}">
                Nhớ mật khẩu? Đăng nhập
            </a>
        </div>
    </form>
@endsection
