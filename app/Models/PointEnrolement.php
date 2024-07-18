<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointEnrolement extends Model
{
    use HasFactory;
    protected $table = "point_enrolement";
    protected $primaryKey = "id_pe";

public function services()
{
    return $this->belongsToMany(Service::class, "service_point_enrolement", "point_enrolement_id", "service_id");
}

}
