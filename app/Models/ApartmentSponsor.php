<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentSponsor extends Model
{
    use HasFactory;

    protected $table = "apartment_sponsor";

    protected $fillable = [
        'sponsor_id', 'apartment_id',
        'starting_date', 'expiring_date'
    ];
}