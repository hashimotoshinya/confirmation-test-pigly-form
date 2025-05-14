<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録 - STEP1</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap">
    <link rel="stylesheet" href="{{ asset('css/step1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <div class="card">
        <h1>PiGLy</h1>
        <p>新規会員登録<br><small>STEP1 アカウント情報の登録</small></p>
        
        <form action="/register/step1" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="名前を入力">
                @error('name')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力">
                @error('email')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="パスワードを入力">
                @error('password')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-btn">次に進む</button>
        </form>

        <div class="login-link">
            <a href="/login">ログインはこちら</a>
        </div>
    </div>
</body>
</html>