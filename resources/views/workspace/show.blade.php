@extends('layout')

@section('title')
    Workspace Details
@endsection

@section('content')
    @if ($showworkspaces)
        <h2 class="text-white mb-4 ms-4 mt-2 text-center">{{ $showworkspaces->name }}</h2>

        <div class="d-flex align-items-start board">
            @foreach ($showworkspaces->boards as $board)
                <div class="list bg-light p-2 me-3 rounded" style="min-width: 200px;">

                    <div class="position-relative">
                        <!-- Tên board -->
                        <h5 class="mb-0" id="board-name-{{ $board->id }}">
                            {{ $board->name }}
                        </h5>

                        <!-- Form sửa (ẩn ban đầu) -->
                        <form action="{{ route('boards.update', $board->id) }}" method="POST"
                            id="edit-form-{{ $board->id }}" class="d-none">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $board->name }}"
                                class="form-control form-control-sm">
                        </form>

                        <!-- Actions -->
                        <div class="position-absolute top-0 end-0 d-flex gap-1" style="transform: translateY(-5px);">

                            <!-- Sửa -->
                            <button class="btn btn-sm btn-outline-primary" onclick="toggleEdit({{ $board->id }})">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <!-- Xóa -->
                            <form action="{{ route('boards.destroy', $board->id) }}" method="POST"
                                onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('oke')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                        </div>

                    </div>

                    <div class="cards">
                        {{-- Render cards sau này --}}
                    </div>

                    <div class="add-card mt-2" onclick="toggleCardInput(this)">+ Thêm thẻ</div>

                    <div class="input-area d-none mt-2">
                        <form onsubmit="submitBoard(event, this)" data-workspace-id="{{ $showworkspaces->id }}"
                            action="{{ route('boards.store') }}" method="POST">
                            @csrf
                            <input type="text" name="name" class="form-control mb-1" placeholder="Tên danh sách..."
                                required>
                            <button type="submit" class="btn btn-primary btn-sm w-100">Thêm</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Thêm list mới -->
            <div class="list bg-light p-2 rounded add-board" style="min-width: 200px;">
                <h5 onclick="toggleBoardInput(this)" style="cursor: pointer;">+ Thêm danh sách</h5>

                <div class="input-area d-none mt-2">

                    <form action="{{ route('boards.store') }}" method="POST">
                        @csrf
                        <input type="text" name="name" class="form-control mb-1" placeholder="Tên công việc ..."
                            required>
                        <input type="hidden" name="workspace_id" value="{{ $showworkspaces->id }}">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    @else
        <p class="text-white">Chọn workspace bên trái để xem boards.</p>
    @endif
    <script>
        function toggleCardInput(el) {
            const inputArea = el.nextElementSibling;
            inputArea.classList.toggle('d-none');
            if (!inputArea.classList.contains('d-none')) {
                inputArea.querySelector('input[name="title"]').focus();
            }
        }

        function toggleBoardInput(el) {
            const inputArea = el.nextElementSibling;
            inputArea.classList.toggle('d-none');
            if (!inputArea.classList.contains('d-none')) {
                inputArea.querySelector('input[name="name"]').focus();
            }
        }
    </script>
@endsection
