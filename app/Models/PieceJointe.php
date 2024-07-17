<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PieceJointe extends Model
{
    use HasFactory;

    protected $table = "piece_jointes";

    protected $fillable = ['url', 'demande_id', 'user_id', 'libelle'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // produit

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id', 'id');
    }

}
