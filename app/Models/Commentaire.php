<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    public $table = 'commentaires';
    protected $fillable = [
        'description',
        "historique_id",
    ];
    public $timestamps = false;
    public function historique()
    {
        return $this->belongsTo(Historique::class, 'historique_id', 'id');
    }
}
