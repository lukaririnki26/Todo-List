<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoSummaryByStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status_summary' => [
                'pending' => $this->pending ?? 0,
                'open' => $this->open ?? 0,
                'in_progress' => $this->in_progress ?? 0,
                'completed' => $this->completed ?? 0,
            ]
        ];
    }
}
