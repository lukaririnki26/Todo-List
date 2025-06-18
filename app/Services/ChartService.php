<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Support\Fluent;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TodoSummaryByStatusResource;
use App\Http\Resources\TodoSummaryByAssigneeResource;
use App\Http\Resources\TodoSummaryByPriorityResource;

class ChartService
{
    public function handle(string $type)
    {
        return match ($type) {
            'status'   => $this->byStatus(),
            'priority' => $this->byPriority(),
            'assignee' => $this->byAssignee(),
            default    => response()->json(['error' => 'Invalid type'], 422),
        };
    }

    protected function byStatus()
    {
        $data = Todo::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return new TodoSummaryByStatusResource(new Fluent($data));
    }

    protected function byPriority()
    {
        $data = Todo::select('priority', DB::raw('count(*) as total'))
            ->groupBy('priority')
            ->pluck('total', 'priority');

        return new TodoSummaryByPriorityResource(new Fluent($data));
    }

    protected function byAssignee()
    {
        $data = Todo::select(
            'assignee',
            DB::raw('COUNT(*) as total_todos'),
            DB::raw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as total_pending_todos"),
            DB::raw("SUM(CASE WHEN status = 'completed' THEN time_tracked ELSE 0 END) as total_timetracked_completed_todos")
        )
            ->groupBy('assignee')
            ->get();

       return new TodoSummaryByAssigneeResource($data);
    }
}
