<?php
namespace App\Exports;

use App\Models\Todo;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class TodoExport implements FromCollection, WithHeadings
{
    public function __construct(public Request $request) {}

    public function collection()
    {
        $todos = Todo::query()
            ->when($title = $this->request->input('title'), function ($q) use ($title) {
                $q->where('title', 'like', "%{$title}%");
            })
            ->when($assignee = $this->request->input('assignee'), function ($q) use ($assignee) {
                $q->whereIn('assignee', explode(',', $assignee));
            })
            ->when($status = $this->request->input('status'), function ($q) use ($status) {
                $q->whereIn('status', explode(',', $status));
            })
            ->when($priority = $this->request->input('priority'), function ($q) use ($priority) {
                $q->whereIn('priority', explode(',', $priority));
            })
            ->when($fromDate = $this->request->input('start'), function ($q) use ($fromDate) {
                $q->whereDate('due_date', '>=', $fromDate);
            })
            ->when($toDate = $this->request->input('end'), function ($q) use ($toDate) {
                $q->whereDate('due_date', '<=', $toDate);
            })
            ->when($minTime = $this->request->input('min'), function ($q) use ($minTime) {
                $q->where('time_tracked', '>=', (float) $minTime);
            })
            ->when($maxTime = $this->request->input('max'), function ($q) use ($maxTime) {
                $q->where('time_tracked', '<=', (float) $maxTime);
            })
            ->get();

        return $todos->map(function ($todo) {
            return [
                $todo->title,
                $todo->assignee,
                $todo->due_date,
                $todo->time_tracked,
                $todo->status,
                $todo->priority,
            ];
        });
    }

    public function headings(): array
    {
        return ['Title', 'Assignee', 'Due Date', 'Time Tracked', 'Status', 'Priority'];
    }
}
