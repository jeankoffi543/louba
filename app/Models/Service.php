<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "service";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'description',
        'image',
        'is_public',
        'is_disable',
        'habiletes',
    ];

    protected $casts = [
        'habiletes' => 'array',
    ];
}
