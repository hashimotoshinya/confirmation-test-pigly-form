<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
        <div class="login-card">
        <h1>PiGLy</h1>
        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email">
                @error('email')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password">
                @error('password')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">ログイン</button>

            <p><a href="{{ url('/register/step1') }}">アカウント作成はこちら</a></p>
        </form>
    </div>
</body>
</html>