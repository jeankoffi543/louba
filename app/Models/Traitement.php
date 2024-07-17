<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    use HasFactory;

    protected $fillable = [
        'habilete_id',
        'id_demande',
        'action',
        'user_id',
    ];

    public function habilete()
    {
        return $this->belongsTo(Habilete::class);
    }

    public function demandes()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}