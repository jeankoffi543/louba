<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'habilete_id',
        'id_demande',
        'action',
    ];

    public function habilete()
    {
        return $this->belongsTo(Habilete::class);
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande');
    }
}