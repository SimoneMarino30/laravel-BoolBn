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

    // Relazione con tabella sponsors
    public function sponsors() {
        return $this->belongsToMany(Sponsor::class);
    }

    // Relazione con tabella messages
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
}