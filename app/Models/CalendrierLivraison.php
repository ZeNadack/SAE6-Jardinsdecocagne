<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendrierLivraison extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournee_id',
        'date_livraison',
        'est_livrable',
        'frequence',
    ];


    public function tournee()
    {
        return $this->belongsTo(Tournee::class);
    }
}