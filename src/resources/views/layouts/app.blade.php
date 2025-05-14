<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiGLy</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">PiGLy</h1>

            <nav class="nav">
                <a href="{{ route('weight_logs.index') }}" class="nav-link">ホーム</a>

                @auth
                    <a href="{{ route('weight_logs.goal_setting') }}" class="nav-link">
                        <i class="fas fa-bullseye"></i> 目標体重設定
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                        @csrf
                        <button type="submit" class="logout-button">
                            <i class="fas fa-sign-out-alt"></i> ログアウト
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="nav-link">ログイン</a>
                @endguest
            </nav>
        </div>
    </header>

    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>