<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'surname',
        'date_of_birth',
        'profile_img'
    ];

    // * RELAZIONI
    
    // Relazione con tabella users
    public function user(){
        return $this->belongsTo(User::class);
    }
}