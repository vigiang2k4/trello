@extends('account.master')

@section('title')
    Đăng ký tài khoản
@endsection

@section('content')
    <form class="login100-form validate-form" action="{{ route('register_') }}" method="POST">

        @csrf

        <span class="login100-form-title p-b-49">
            Đăng ký tài khoản
        </span>

        @error('email')
            <div class="text-danger mt-3">{{ $message }}</div>
        @enderror
        @error('password')
            <div class="text-danger mt-3">{{ $message }}</div>
        @enderror

        <div class="wrap-input100 validate-input m-b-23 mt-3" data-validate="Vui lòng nhập email">
            <span class="label-input100">Email</span>
            <input class="input100" type="email" name="email" placeholder="Nhập email của bạn"
                value="{{ old('email') }}">
            <span class="focus-input100" data-symbol="&#xf1fa;"></span>
        </div>

        <div class="wrap-input100 validate-input " data-validate="Vui lòng nhập mật khẩu">
            <span class="label-input100">Mật khẩu</span>
            <input class="input100" type="password" name="password" placeholder="Tạo mật khẩu"
                value="{{ old('password') }}">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>

        <div class="wrap-input100 validate-input " data-validate="Vui lòng xác nhận mật khẩu">
            <span class="label-input100">Xác nhận mật khẩu</span>
            <input class="input100" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu"
                value="{{ old('password_confirmation') }}">
            <span class="focus-input100" data-symbol="&#xf190;"></span>
        </div>
        @error('password_confirmation')
            <div class="text-danger mt-3">{{ $message }}</div>
        @enderror

        <div class="container-login100-form-btn mt-3 m-3">
            <div class="wrap-login100-form-btn">
                <div class="login100-form-bgbtn"></div>
                <button class="login100-form-btn" type="submit">
                    Đăng ký
                </button>
            </div>
        </div>

    </form>

    <div class="text-center p-t-8 p-b-31">
        <a href="{{ route('login') }}">
            Đã có tài khoản? Đăng nhập
        </a>
    </div>
@endsection
