<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObjectivesResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "Id"        => $this->id,
            "Name"      => $this->objective_name,
            "Value"     => $this->objective_value,
            "Current"   => $this->current_value,
            "Completed" => $this->completed,
        ];
    }
}
