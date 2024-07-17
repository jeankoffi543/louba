<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClasseSignalementCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $allHabiletes = \App\Models\Habilete::all();
        return [
            'data' => $this->collection,
            'liste_des_habiletes' => $allHabiletes->pluck('id', 'name')->toArray(),
        ];
    }
}
