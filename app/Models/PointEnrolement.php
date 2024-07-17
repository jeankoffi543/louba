<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointEnrolement extends Model
{
    use HasFactory;
    protected $table = "point_enrolement";
    protected $primaryKey = "id_pe";



}
