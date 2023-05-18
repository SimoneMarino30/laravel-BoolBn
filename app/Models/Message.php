<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['apartment_id', 'name', 'surname', 'email', 'text'];

    // * RELAZIONI

    // Relazione con tabella apartments
    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }

    // * GETTER

     // Funzione che ritorna una sottostringa e accetta come parametro il numero massimo di caratteri desiderati, con un valore di default di 30
     public function getAbstract($max = 30) {
        return substr($this->text, 0 , $max) . "...";
    }

    // * MUTATORS

    protected function getCreatedAtAttribute($value) {
        // return date('d/m/Y H:i', strtotime($value));
        Carbon::setLocale('it');
        $date_from = Carbon::create($value);
        $date_now = Carbon::now();
        return str_replace('prima', 'fa', $date_from->diffForHumans($date_now));
    }
}