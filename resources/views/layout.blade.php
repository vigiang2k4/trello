<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Mini Trello Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #6a5acd, #d16ba5);
            min-height: 100vh;
            overflow-x: auto;
        }

        /* GIỮ NGUYÊN layout Trello */
        .board {
            display: flex;
            gap: 16px;
            padding: 20px;
        }

        .list {
            background: #ebecf0;
            border-radius: 10px;
            width: 280px;
            padding: 10px;
            flex-shrink: 0;
        }

        .list h5 {
            font-weight: bold;
        }

        .card-item {
            background: #fff;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: grab;
        }

        .add-card {
            cursor: pointer;
            color: #6c757d;
        }

        .add-card:hover {
            color: #000;
        }
    </style>
</head>

<body>
    <!-- ALERT -->
    <header>
        @if (session('success'))
            <div class="alert alert-success text-center mb-0">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger text-center mb-0">
                {{ session('error') }}
            </div>
        @endif
    </header>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark px-3" style="background: rgba(0,0,0,0.2); backdrop-filter: blur(10px);">

        <div class="d-flex align-items-center">
            @if (Request::is('workspaces/*'))
                <!-- Nút quay lại -->
                <a href="/" class="btn btn-light btn-sm me-2">
                    ← Quay lại
                </a>
            @else
                <!-- Mặc định -->
                <span class="navbar-brand mb-0 h5">Mini Trello</span>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">

            <!-- User -->
            <div class="d-flex align-items-center text-white gap-2">
                @auth
                    <span>Xin chào: {{ Auth::user()->email }}</span>
                    <img src="https://i.pravatar.cc/40" class="rounded-circle" width="40">
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm">Đăng nhập</a>
                @endguest
            </div>

            <!-- Notification -->
            <button class="btn btn-light position-relative">
                <i class="bi bi-bell"></i>
                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                    3
                </span>
            </button>

            <!-- Share -->
            <button class="btn btn-light">
                <i class="bi bi-share"></i>
            </button>

            <!-- Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light" data-bs-toggle="dropdown">
                    <i class="bi bi-list"></i>
                </button>

                <ul id="dropdownMenu" class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Hồ sơ</a></li>
                    <li><a class="dropdown-item" href="#">Cài đặt</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="px-3">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"
                                onclick="return confirm('Bạn có muốn đăng xuất không?')">
                                Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container-fluid">
        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- dropdown menu -->
    <script>
        const btn = document.getElementById('menuBtn');
        const menu = document.getElementById('dropdownMenu');

        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.classList.toggle('show');
        });

        document.addEventListener('click', function() {
            menu.classList.remove('show');
        });

        menu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    </script>

</body>

</html>
