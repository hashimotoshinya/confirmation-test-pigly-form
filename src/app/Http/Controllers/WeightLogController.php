<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\StoreWeightLogRequest;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Http\Requests\GoalUpdateRequest;

class WeightLogController extends Controller
{
    public function index(Request $request)
    {
        $query = WeightLog::query();

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }
        elseif ($request->filled('from')) {
            $query->where('date', '>=', $request->from);
        }
        elseif ($request->filled('to')) {
            $query->where('date', '<=', $request->to);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(7);

        $currentWeight = WeightLog::orderBy('date', 'desc')->value('weight');
        $targetWeight = WeightTarget::orderBy('created_at', 'desc')->value('target_weight');


        return view('weight_logs.index', compact('weightLogs', 'currentWeight', 'targetWeight'));

    }

    public function create() {
        return view('weight_logs.create');
    }

    public function store(StoreWeightLogRequest $request){
        WeightLog::create(array_merge(
            $request->validated(),
            ['user_id' => auth()->id()]
        ));

        return redirect()->route('weight_logs.index')->with('message', '登録が完了しました');
    }

    public function edit($id){
        $weightLog = WeightLog::findOrFail($id);

        return view('weight_logs.update', compact('weightLog'));
    }

    public function update(UpdateWeightLogRequest $request, $id)
    {
        $log = WeightLog::findOrFail($id);

        $validated = $request->validated();

        $log->update($validated);

        return redirect()->route('weight_logs.index')->with('message', '更新しました');
    }

    public function show($weightLogId) {
        return view('weight_logs.show', compact('weightLogId'));
    }

    public function deleteConfirm($weightLogId){
        $weightLog = WeightLog::findOrFail($weightLogId);

        return view('weight_logs.delete', compact('weightLog'));
    }

    public function destroy($weightLogId) {
        $weightLog = WeightLog::findOrFail($weightLogId);
        $weightLog->delete();

        return redirect()->route('weight_logs.index')->with('message', '削除しました');
    }

    public function goalSetting() {
        $user = Auth::user();

        $target = WeightTarget::where('user_id', $user->id)->first();

        return view('weight_logs.goal_setting', compact('target'));
    }

    public function goalUpdate(GoalUpdateRequest $request) {

        $user = Auth::user();

        $target = WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index')->with('status', '目標体重を更新しました');
    }

    public function search(Request $request){
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        $query = WeightLog::query();

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }
        elseif ($request->filled('from')) {
            $query->where('date', '>=', $request->from);
        }
        elseif ($request->filled('to')) {
            $query->where('date', '<=', $request->to);
        }

        $logs = $query->orderBy('date', 'desc')->paginate(7);
        $count = $logs->total();

        return view('weight_logs.search', [
            'logs' => $logs,
            'count' => $count,
            'start_date' => $request->from,
            'end_date' => $request->to,
        ]);
    }
}
