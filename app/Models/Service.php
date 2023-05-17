<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Apartment;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // * RELAZIONI

    // Relazione con tabella apartments
    public function apartments() {
        return $this->belongsToMany(Apartment::class);
    }
}