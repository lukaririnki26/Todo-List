<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Exports\TodoExport;
use Illuminate\Http\Request;
use App\Services\ChartService;
use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use Maatwebsite\Excel\Facades\Excel;

class TodoController extends Controller
{
    public function store(TodoRequest $request)
    {
        $todo = Todo::create(array_merge(
            $request->validated(),
            ['status' => $request->status ?? 'pending']
        ));

        return new TodoResource($todo);
    }

    public function export(Request $request)
    {
        return Excel::download(new TodoExport($request), 'todos.xlsx');
    }

    public function chart(Request $request, ChartService $chartService)
    {
        $request->validate([
            'type' => 'required|in:status,priority,assignee'
        ]);
        return $chartService->handle($request->query('type'));
    }
}
