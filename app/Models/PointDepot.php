<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointDepot extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'adresse',
        'code_postal',
        'ville',
        'commentaires',
        'latitude',
        'longitude', 
    ];


    public function tournees()
    {
        return $this->belongsToMany(Tournee::class, 'point_depot_tournee')
                    ->withPivot('ordre'); // Inclure la colonne "ordre" dans la relation
    }
}