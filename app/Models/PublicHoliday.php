<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicHoliday extends Model
{
    use HasFactory;

    protected $fillable = ['*'];

    /**
     * Get the user that owns the PublicHoliday
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enrolement()
    {
        return $this->belongsTo(PointEnrolement::class, 'id_point_enrolement');
    }
}
