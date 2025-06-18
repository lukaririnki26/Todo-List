<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoSummaryByAssigneeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $result = [];

        foreach ($this->resource as $item) {
            $result[$item->assignee] = [
                'total_todos' => (int) $item->total_todos,
                'total_pending_todos' => (int) $item->total_pending_todos,
                'total_timetracked_completed_todos' => (float) $item->total_timetracked_completed_todos,
            ];
        }

        return ['assignee_summary' => $result];
    }
}
