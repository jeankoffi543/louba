<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = "demande";
    protected $primaryKey = "id";

    protected $fillable = ['*'];
    public $timestamps = true;

    public function point_enrolement()
    {
        return $this->belongsTo(PointEnrolement::class, 'id_point_enrolement', 'id_pe');
    }

    // produit

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }

    public function paiement()
    {
        return $this->hasMany(Paiement::class, 'id_demande', 'id_pay');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'id_client', 'id');
    }
    public function sender()
    {
        return $this->belongsTo(Client::class, 'id_sender', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }

    public function piece_jointes()
    {
        return $this->hasMany(PieceJointe::class, 'demande_id', 'id');
    }
}
