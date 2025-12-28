<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeRegistration extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id','name','mobile','email','photo',
        'bike_name','registration_no','bike_photo',
        'registration_fee','payment_method','payment_slip','password','status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
