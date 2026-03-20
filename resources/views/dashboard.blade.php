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
                <p class="border"></p>

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
                        <li
                            class="list-group-item bg-transparent border-0 p-1 d-flex justify-content-between align-items-start">

                            <!-- LEFT -->
                            <div class="flex-grow-1">
                                <a href="{{ route('workspaces.show', ['workspace' => $workspaceItem->id]) }}"
                                    class="text-white text-decoration-none workspace-name">
                                    <h6 class="ms-1 mb-1">{{ $workspaceItem->name }}</h6>
                                    <p class="border m-1"></p>
                                </a>

                                <!-- FORM EDIT -->
                                <form method="POST" action="{{ route('workspaces.update', $workspaceItem->id) }}"
                                    class="edit-form d-none ms-1">
                                    @csrf
                                    @method('PUT')

                                    <input type="text" name="name" class="form-control form-control-sm mb-1"
                                        value="{{ $workspaceItem->name }}">

                                    <button class="btn btn-sm btn-success">Lưu</button>
                                    <button type="button" class="btn btn-sm btn-secondary cancel-btn">Hủy</button>
                                </form>
                            </div>

                            <!-- RIGHT -->
                            <div class="d-flex align-items-center gap-1">
                                <!-- Nút Sửa ngoài dropdown -->
                                <button type="button" class="btn btn-sm text-white edit-btn" title="Sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <!-- Dropdown Xóa -->
                                <div class="dropdown">
                                    <button class="btn btn-sm text-white" data-bs-toggle="dropdown">
                                        ⋮
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <form method="POST" action="{{ route('workspaces.destroy', $workspaceItem->id) }}"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger delete-btn"
                                                    title="Xóa workspace">
                                                    <i class="bi bi-trash-fill"></i>
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <a href="#" title="Mời / Share">
                                                <i class="bi bi-share-fill ms-3 m-3"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

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

        <script>
            document.addEventListener("DOMContentLoaded", function() {

                document.querySelectorAll(".edit-btn").forEach(btn => {
                    btn.addEventListener("click", function(e) {
                        const li = e.target.closest("li");
                        const workspaceName = li.querySelector(".workspace-name");
                        const editForm = li.querySelector(".edit-form");

                        if (workspaceName && editForm) {
                            workspaceName.classList.add("d-none");
                            editForm.classList.remove("d-none");
                        }
                    });
                });

                document.querySelectorAll(".cancel-btn").forEach(btn => {
                    btn.addEventListener("click", function(e) {
                        const li = e.target.closest("li");
                        const workspaceName = li.querySelector(".workspace-name");
                        const editForm = li.querySelector(".edit-form");

                        if (workspaceName && editForm) {
                            workspaceName.classList.remove("d-none");
                            editForm.classList.add("d-none");
                        }
                    });
                });

                document.querySelectorAll('.delete-form').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        if (!confirm('Bạn có chắc muốn xóa workspace này?')) {
                            e.preventDefault();
                        }
                    });
                });

            });
        </script>
    @endauth
@endsection
