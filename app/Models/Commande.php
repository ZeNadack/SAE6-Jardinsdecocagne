<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    /**
     *
     * @var array
     */
    protected $fillable = [
        'adherent_id',
        'abonnement_id',
        'point_depot_id',
        'date_livraison',
    ];

    /**
     */
    public function adherent()
    {
        return $this->belongsTo(Adherent::class);
    }


    public function abonnement()
    {
        return $this->belongsTo(Abonnement::class);
    }

    public function pointDepot()
    {
        return $this->belongsTo(PointDepot::class);
    }
}