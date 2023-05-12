<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    // * RELAZIONI

    // Relazione con tabella services
    public function services() {
        return $this->belongsToMany(Service::class);
    }

    // Relazione con tabella services
    public function sponsors() {
        return $this->belongsToMany(Sponsor::class);
    }
    
}