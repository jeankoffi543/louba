<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    use HasFactory;

    protected $table = "historiques";

    protected $fillable = ['description', 'user_id', 'demande_id', 'client_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id', 'id');
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'historique_id', 'id');
    }

}
