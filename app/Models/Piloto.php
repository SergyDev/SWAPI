<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piloto extends Model
{
    protected $fillable = ['piloto_id', 'starship_id', 'starship_name', 'piloto_name'];
    protected $table = 'pilotos';



    public function starships()
    {
        // return $this->belongsToMany(Starship::class)->withPivot('piloto_name', 'starship_name');
        return $this->belongsToMany(Starship::class, 'piloto_starship', 'piloto_id', 'starship_id')->withPivot('piloto_name', 'starship_name');
    }
}