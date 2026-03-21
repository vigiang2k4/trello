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
                                class="form-control form-control-sm" onkeydown="handleEditKey(event, {{ $board->id }})"
                                onblur="cancelEdit({{ $board->id }})">
                        </form>

                        <!-- Actions -->
                        <div class="position-absolute top-0 end-0 d-flex gap-1" style="transform: translateY(-5px);">

                            <!-- Sửa -->
                            <button type="button" class="btn btn-sm btn-outline-primary"
                                onclick="toggleEdit({{ $board->id }})">
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
            <div class="cards" id="cards-{{ $board->id }}">
                @foreach ($board->tasks as $task)
                    <div class="card p-2 mb-1">
                        {{ $task->title }}
                    </div>
                @endforeach
            </div>

            <div class="add-card mt-2" onclick="toggleCardInput(this)">+ Thêm thẻ</div>

            <div class="input-area d-none mt-2">
                <form onsubmit="submitTask(event, this)" data-board-id="{{ $board->id }}"
                    action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input type="text" name="title" class="form-control mb-1" placeholder="Nhập tên thẻ..." required>
                    <button type="submit" class="btn btn-primary btn-sm w-100">Thêm</button>
                </form>
            </div>
        </div>
    @else
        <p class="text-white">Chọn workspace bên trái để xem boards.</p>
    @endif

    <script>
        // thêm board
        function toggleBoardInput(el) {
            // el chính là <h5> "+ Thêm bảng"
            const inputArea = el.nextElementSibling; // div.input-area
            inputArea.classList.toggle('d-none'); // show/hide

            if (!inputArea.classList.contains('d-none')) {
                // focus vào input đầu tiên
                const input = inputArea.querySelector('input[name="name"]');
                input.focus();
                input.select();
            }
        }
    </script>
    <script>
        //update board
        function toggleEdit(boardId) {
            const nameEl = document.getElementById('board-name-' + boardId);
            const formEl = document.getElementById('edit-form-' + boardId);

            nameEl.classList.add('d-none');
            formEl.classList.remove('d-none');

            const input = formEl.querySelector('input[name="name"]');
            input.dataset.original = input.value; // lưu giá trị cũ
            input.focus();
            input.select();
        }

        function handleEditKey(e, boardId) {
            if (e.key === 'Enter') {
                e.preventDefault();

                if (confirm('Bạn có chắc muốn đổi tên board không?')) {
                    submitEdit(boardId);
                }
            }

            if (e.key === 'Escape') {
                cancelEdit(boardId);
            }
        }

        function submitEdit(boardId) {
            const formEl = document.getElementById('edit-form-' + boardId);
            formEl.submit();
        }

        function cancelEdit(boardId) {
            const nameEl = document.getElementById('board-name-' + boardId);
            const formEl = document.getElementById('edit-form-' + boardId);
            const input = formEl.querySelector('input[name="name"]');

            // reset lại giá trị ban đầu
            input.value = input.dataset.original;

            formEl.classList.add('d-none');
            nameEl.classList.remove('d-none');
        }
    </script>

    <script>
        //them task
        function toggleCardInput(el) {
            const inputArea = el.nextElementSibling; // div.input-area
            inputArea.classList.toggle('d-none');

            if (!inputArea.classList.contains('d-none')) {
                inputArea.querySelector('input[name="title"]').focus();
            }
        }

        function submitTask(e, form) {
            e.preventDefault();

            const input = form.querySelector('input[name="title"]');
            const title = input.value.trim();
            const boardId = form.dataset.boardId;
            const action = form.action;
            const token = form.querySelector('input[name="_token"]').value;

            if (!title) return;

            fetch(action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        title: title,
                        board_id: boardId
                    })
                })
                .then(res => res.json())
                .then(data => {
                    // append task mới vào UI
                    const cardContainer = document.getElementById('cards-' + boardId);

                    const newCard = document.createElement('div');
                    newCard.className = 'card p-2 mb-1';
                    newCard.innerText = data.title;

                    cardContainer.appendChild(newCard);

                    // reset input
                    input.value = '';
                    input.focus();
                })
                .catch(err => console.error(err));
        }
    </script>
@endsection
