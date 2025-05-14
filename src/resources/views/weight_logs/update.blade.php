@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Weight Log</h2>

    <form action="{{ route('weight_logs.update', $weightLog->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>日付 <span class="text-danger">※</span></label>
            <input type="date" name="date" value="{{ old('date', $weightLog->date) }}" class="form-control">
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>時間 <span class="text-danger">※</span></label>
            <input type="time" name="time" value="{{ old('time', $weightLog->time) }}" class="form-control">
            @error('time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>体重 (kg) <span class="text-danger">※</span></label>
            <input type="text" name="weight" value="{{ old('weight', $weightLog->weight) }}" class="form-control">
            @error('weight')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>摂取カロリー <span class="text-danger">※</span></label>
            <input type="text" name="calories" value="{{ old('calories', $weightLog->calories) }}" class="form-control">
            @error('calories')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>運動時間 (分) <span class="text-danger">※</span></label>
            <input type="time" name="exercise_time" class="form-control" value="{{ old('exercise_time', $weightLog->exercise_time ?? '') }}">
            @error('exercise_time')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>運動内容</label>
            <textarea name="exercise_description" class="form-control" rows="3">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
            @error('exercise_content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="button-group" style="display:flex; justify-content: space-between; align-items: center; margin-top:20px;">
            <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>

            <div>
                <button type="submit" class="btn btn-primary">更新</button>

                <a href="{{ route('weight_logs.delete', $weightLog->id) }}" class="btn btn-danger">
                    ゴミ箱
                </a>
            </div>
        </div>
    </form>
</div>
@endsection
