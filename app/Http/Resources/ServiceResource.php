<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'habiletes' => $this->habilete,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'is_public' => $this->is_public,
            'is_disable' => $this->is_disable,
            // ...
        ];
    }
}