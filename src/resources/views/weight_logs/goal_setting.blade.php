@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">

<div class="card">
    <h1>目標体重設定</h1>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form action="{{ route('weight_logs.goal_update') }}" method="POST">
        @csrf
        <div>
            <input type="number" name="target_weight" id="target_weight" step="0.1"
                value="{{ old('target_weight', optional($target)->target_weight) }}">
            <span class="kg-label">kg</span>

            @error('target_weight')
                <div class="text-danger" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div class="button-group">
            <a href="{{ route('weight_logs.index') }}" class="back-btn">戻る</a>
            <button type="submit" class="submit-btn">更新</button>
        </div>
    </form>
</div>
@endsection