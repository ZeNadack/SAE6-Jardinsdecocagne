<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournee extends Model
{
    use HasFactory;

    protected $fillable = [
        'identifiant',
        'jour_preparation',
        'jour_livraison',
        'couleur',
    ];


    public function pointDepots()
    {
        return $this->belongsToMany(PointDepot::class, 'point_depot_tournee')
            ->withPivot('ordre')
            ->orderBy('ordre');
    }

    public function calendrierLivraisons()
    {
        return $this->hasMany(CalendrierLivraison::class);
    }
}