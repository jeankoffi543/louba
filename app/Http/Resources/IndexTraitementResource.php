<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexTraitementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $signalement = \App\Models\Signalement::all();
        
        return [
            'id' => $this->id,
            'habilete_id' => $this->habilete_id,
            'signalements'=> optional($this->signalements)->toArray(),
            // 'signalement'=> $signalement->toArray(),
        ];
    }
}
