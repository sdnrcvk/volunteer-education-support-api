<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\District;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['city_name'];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
