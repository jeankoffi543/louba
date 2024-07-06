<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
    public $timestamps = false;

    public function habiletes()
    {
        return $this->belongsToMany(Habilete::class);
    }
}
