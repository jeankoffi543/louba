<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    public $table = 'commentaires';
    protected $fillable = [
        'user_id',
        "id_demande",
        "commentaire",
    ];
    public $timestamps = false;
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'id_demande', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
