<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Client extends Authenticatable implements JWTSubject
{
    use HasFactory;

    protected $table = "client";
    protected $primaryKey = "id";

    protected $fillable = [
    ];
    protected $hidden = [

        "password",
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
