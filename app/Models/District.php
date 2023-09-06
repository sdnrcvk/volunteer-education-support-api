<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\City;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city_id',
        'district_name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
