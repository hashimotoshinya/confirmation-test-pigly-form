@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

<div class="container">
    <h2>{{ $start_date }}〜{{ $end_date }} の検索結果（{{ $count }}件）</h2>

    <div class="search-bar">
        <a href="{{ route('weight_logs.index') }}" class="btn-reset">リセット</a>
    </div>

    @if($logs->isEmpty())
        <p>該当するデータが見つかりませんでした。</p>
    @else
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
                @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->weight }}kg</td>
                        <td>{{ $log->calories }}kcal</td>
                        <td>{{ $log->exercise_time }}分</td>
                        <td>
                            <a href="{{ route('weight_logs.edit', $log->id) }}">
                                <i class="edit-icon fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
        {{ $logs->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
    @endif
</div>
@endsection