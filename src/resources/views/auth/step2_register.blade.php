<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規会員登録 - STEP2</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap">
    <link rel="stylesheet" href="{{ asset('css/step2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
</head>
<body>
    <div class="card">
        <h1>PiGLy</h1>
        <p>新規会員登録<br><small>STEP2 体重データの入力</small></p>

        <form action="{{ route('register.step2.form') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_weight">現在の体重</label>
                <input type="text" id="weight" name="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力">kg
                @error('current_weight')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="target_weight">目標の体重</label>
                <input type="text" id="target_weight" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力">kg
                @error('target_weight')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="submit-btn">アカウント作成</button>
            </div>
        </form>
    </div>
</body>
</html>