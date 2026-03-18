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
                    <h5>{{ $board->name }}</h5>

                    <div class="cards">
                        {{-- Render cards sau này --}}
                    </div>

                    <div class="add-card mt-2" onclick="toggleCardInput(this)">+ Thêm thẻ</div>

                    <div class="input-area d-none mt-2">
                        <form onsubmit="submitCard(event, this)" data-board-id="{{ $board->id }}">
                            @csrf
                            <input type="text" name="title" class="form-control mb-1" placeholder="Nhập nội dung..."
                                required>
                            <button type="submit" class="btn btn-primary btn-sm w-100">Thêm</button>
                        </form>
                    </div>
                </div>
            @endforeach

            <!-- Thêm list mới -->
            <div class="list bg-light p-2 rounded" style="min-width: 200px;">
                <h5>+ Thêm danh sách</h5>
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
    </script>
@endsection
