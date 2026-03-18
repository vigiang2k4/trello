@extends('layout')

@section('title')
    Dashboard
@endsection

@section('content')
    @guest
        <div class="text-center text-white mt-5">
            <h3>📋 Mini Trello</h3>
            <p>Bạn cần đăng nhập để sử dụng Mini Trello</p>

            <a href="{{ route('login') }}" class="btn btn-light mt-3">Đăng nhập</a>
        </div>
    @endguest

    @auth
        <div class="d-flex mt-3" style="height: calc(100vh - 80px);">

            <!-- Sidebar: danh sách workspace -->
            <div class="bg light text-white p-3" style="width: 250px; min-width: 200px; overflow-y: auto;">
                <div class="d-flex align-items-center mb-3">
                    <h3 class="ms-2">Workspaces</h3>
                    <button class="btn btn-primary btn-sm ms-auto" id="addWorkspaceBtnSidebar">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                </div>

                <!-- Form thêm workspace ẩn -->
                <div id="addWorkspaceFormSidebar" class="mb-3 d-none">
                    <form action="{{ route('workspaces.store') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="text" name="name" class="form-control me-2" placeholder="Tên workspace..." required>
                        <button type="submit" class="btn btn-success btn-sm">Thêm</button>
                        <button type="button" class="btn btn-secondary btn-sm ms-1" id="cancelWorkspaceBtnSidebar">Hủy</button>
                    </form>
                </div>

                <ul class="list-group list-group-flush">
                    @foreach ($allworkspaces as $workspaceItem)
                        <li class="list-group-item bg-transparent border-0 p-1">
                            <a href="{{ route('workspaces.show', ['workspace' => $workspaceItem->id]) }}"
                                class="text-white text-decoration-none">
                                <h6 class="ms-1">{{ $workspaceItem->name }}</h6>
                            </a>
                            <p class="border-bottom mb-0 m-1"></p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-dark border-end" style="width: 1px; min-width: 1px; overflow-y: auto;"></div>

            <!-- Main area: boards workspace hiện tại -->
            <div class="flex-grow-1 p-3" style="overflow-x: auto;">
                @if (!View::hasSection('content'))
                    <div class="text-center text-white mt-5">
                        <h3>🎉 Chào mừng bạn đến với Mini Trello!</h3>
                        <p>Hãy chọn workspace để bắt đầu.</p>
                    </div>

                    @yield('content')
                @endif
            </div>
        </div>

        <!-- JS toggle form thêm workspace -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const btn = document.getElementById('addWorkspaceBtnSidebar');
                const form = document.getElementById('addWorkspaceFormSidebar');
                const cancel = document.getElementById('cancelWorkspaceBtnSidebar');

                btn.addEventListener('click', function() {
                    form.classList.toggle('d-none');
                });

                cancel.addEventListener('click', function() {
                    form.classList.add('d-none');
                });
            });
        </script>
    @endauth
@endsection
