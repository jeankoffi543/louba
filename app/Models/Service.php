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

    public function pointEnrolements()
    {
        return $this->belongsToMany(PointEnrolement::class,'service_point_enrolement','service_id','point_enrolement_id');
    }
}
