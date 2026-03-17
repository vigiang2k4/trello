@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')

    @guest
        <div class="text-center text-white mt-5">
            <h3>📋 Mini Trello</h3>
            <p>Bạn cần đăng nhập để sử dụng Mini Trello</p>

            <a href="{{ route('login') }}" class="btn btn-light mt-3">
                Đăng nhập
            </a>
        </div>
    @endguest


    @auth
        <h3 class="text-white text-center p-3">📋 Dashboard</h3>

        <div class="board">

            <!-- List -->
            <div class="list">
                <h5>Hôm nay</h5>
                <div class="cards"></div>

                <div class="add-card" onclick="showInput(this)">+ Thêm thẻ</div>
                <div class="input-area d-none">
                    <input type="text" class="form-control" placeholder="Nhập nội dung...">
                    <button class="btn btn-primary btn-sm w-100" onclick="addCard(this)">Thêm</button>
                </div>
            </div>

            <div class="list">
                <h5>Tuần này</h5>
                <div class="cards"></div>

                <div class="add-card" onclick="showInput(this)">+ Thêm thẻ</div>
                <div class="input-area d-none">
                    <input type="text" class="form-control">
                    <button class="btn btn-primary btn-sm w-100" onclick="addCard(this)">Thêm</button>
                </div>
            </div>

            <div class="list">
                <h5>Sau này</h5>
                <div class="cards"></div>

                <div class="add-card" onclick="showInput(this)">+ Thêm thẻ</div>
                <div class="input-area d-none">
                    <input type="text" class="form-control">
                    <button class="btn btn-primary btn-sm w-100" onclick="addCard(this)">Thêm</button>
                </div>
            </div>

             <div class="list">
                <h5>Thêm danh sách khác</h5>
                <div class="cards"></div>

                <div class="add-card" onclick="showInput(this)">+ Thêm thẻ</div>
                <div class="input-area d-none">
                    <input type="text" class="form-control">
                    <button class="btn btn-primary btn-sm w-100" onclick="addCard(this)">Thêm</button>
                </div>
            </div>

        </div>
    @endauth

@endsection
