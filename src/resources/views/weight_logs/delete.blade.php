@extends('layouts.app')

@section('content')
<div class="container">
    <h2>削除確認</h2>

    <div class="alert alert-warning">
        以下の記録を削除してもよろしいですか？
    </div>

    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>日付:</strong> {{ $weightLog->date }}</li>
        <li class="list-group-item"><strong>時間:</strong> {{ $weightLog->time }}</li>
        <li class="list-group-item"><strong>体重:</strong> {{ $weightLog->weight }} kg</li>
        <li class="list-group-item"><strong>摂取カロリー:</strong> {{ $weightLog->calories }} kcal</li>
        <li class="list-group-item"><strong>運動時間:</strong> {{ $weightLog->exercise_time }} 分</li>
        <li class="list-group-item"><strong>運動内容:</strong> {{ $weightLog->exercise_description }}</li>
    </ul>

    <form method="POST" action="{{ route('weight_logs.destroy', $weightLog->id) }}">
        @csrf
        @method('DELETE')

        <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">キャンセル</a>
        <button type="submit" class="btn btn-danger">削除する</button>
    </form>
</div>
@endsection