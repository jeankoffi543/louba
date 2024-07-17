<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndexTraitement extends Model
{
    use HasFactory;
    public $table = 'index_traitement';
    protected $fillable = [
        "id_demande",
        "habilete_id",
    ];
    public $timestamps = false;
    public function demandes()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}
