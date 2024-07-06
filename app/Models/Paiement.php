<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $table = "paiement";
    protected $primaryKey = "id_pay";

    protected $fillable = [
        "amount_pay",
        "reference_pay",
        "id_client",
        "id_demande",
        "created_at",
    ];


    public function client()
    {
        $this->belongsTo(Client::class, 'id_client', 'id');
    }

    public function demande()
    {
        $this->belongsTo(Demande::class, 'id_pay', 'id');
    }
}
