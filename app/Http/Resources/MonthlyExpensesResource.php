<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyExpensesResource extends JsonResource
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
            "Name"      => $this->expense_name,
            "Value"     => $this->expense_value,
            "Parceled"  => $this->parceled,
            "Parcels"   => $this->parcels,
            "Current"   => $this->current_parcel
        ];
    }
}
