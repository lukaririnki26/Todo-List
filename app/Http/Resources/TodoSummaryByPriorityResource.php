<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoSummaryByPriorityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'priority_summary' => [
                'low' => $this->low ?? 0,
                'medium' => $this->medium ?? 0,
                'high' => $this->high ?? 0,
            ]
        ];
    }
}
