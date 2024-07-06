<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HabileteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $permissions = [];
        foreach ($this->permissions as $permission) {
            $permissions[] = $permission->libelle;
        }
        return [
            'id' => $this->id,
            'libelle' => $this->libelle,
            'permissions' => $permissions,
            'admins' => $this->admins,
        ];
    }
}
