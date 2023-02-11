<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'miles' => $this->miles,
            'total' => $this->total,
            'car' => [
                'id' => $this->id,
                'make' => $this->make,
                'model' => $this->model,
                'year' => $this->year
            ]
        ];
    }
}
