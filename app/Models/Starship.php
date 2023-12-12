<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Starship extends Model
{

    protected $fillable = ['name'];

    public function pilotos()
    {
        return $this->belongsToMany(Piloto::class)->withPivot('piloto_name', 'starship_name');
    }
}