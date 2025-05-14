@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-container">

        <div class="card">
            <div class="label">目標の体重</div>
            <div class="value">{{ $targetWeight ?? '-' }} kg</div>
        </div>

        <div class="card">
            <div class="label">差分</div>
            <div class="value">
                @if(isset($currentWeight, $targetWeight))
                    {{ number_format($currentWeight - $targetWeight, 1) }} kg
                @else
                    -
                @endif
            </div>
        </div>

        <div class="card">
            <div class="label">現在の体重</div>
            <div class="value">{{ $currentWeight ?? '-' }} kg</div>
        </div>

    </div>

    <form method="GET" action="{{ route('weight_logs.search') }}" class="search-bar">
        <input type="date" name="from" value="{{ request('from') }}">
        <span>〜</span>
        <input type="date" name="to" value="{{ request('to') }}">
        <button type="submit" class="btn-search">検索</button>
        <a href="{{ route('weight_logs.index') }}" class="btn-reset">リセット</a>
    </form>

    <button class="btn-add" data-bs-toggle="modal" data-bs-target="#registerModal">データを追加</button>

    <table class="table">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>食事摂取カロリー</th>
                <th>運動時間</th>
                <th>編集</th>
            </tr>
        </thead>
        <tbody>
            @forelse($weightLogs as $log)
                <tr>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->weight }}kg</td>
                    <td>{{ $log->calories }}kcal</td>
                    <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}分</td>
                    <td>
                        <a href="{{ route('weight_logs.edit', $log->id) }}">
                            <i class="fas fa-edit edit-icon"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">データがありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $weightLogs->appends(request()->query())->links('vendor.pagination.custom') }}
    </div>

    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('weight_logs.store') }}">
                @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Weight Log</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="date" class="form-label">日付</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', \Carbon\Carbon::today()->format('Y-m-d')) }}">
                            @error('date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="time" class="form-label">時間</label>
                            <input type="time" name="time" class="form-control" value="{{ old('time') }}">
                            @error('time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="weight" class="form-label">体重 (kg)</label>
                            <input type="text" name="weight" class="form-control" value="{{ old('weight') }}">
                            @error('weight')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="calories" class="form-label">摂取カロリー (kcal)</label>
                            <input type="text" name="calories" class="form-control" value="{{ old('calories') }}">
                            @error('calories')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exercise_time" class="form-label">運動時間 (分)</label>
                            <input type="time" name="exercise_time" class="form-control" value="{{ old('exercise_time', $weightLog->exercise_time ?? '') }}">
                            @error('exercise_time')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exercise_description" class="form-label">運動内容</label>
                            <textarea name="exercise_description" class="form-control" rows="2">{{ old('exercise_description') }}</textarea>
                            @error('exercise_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    </div>
                    @if ($errors->any())
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var myModal = new bootstrap.Modal(document.getElementById('registerModal'));
                                myModal.show();
                            });
                        </script>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection