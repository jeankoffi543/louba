<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilete extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
    public $timestamps = false;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // public function adminActions(){
    //     return $this->hasMany(AdminAction::class);    
    // }
}
