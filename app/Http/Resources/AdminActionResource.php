<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminActionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'habiletes' => $this->habilete,
            'signalement' => new SignalementResource($this->signalement),
            'action' => $this->action,
            // ...
        ];
    }
}