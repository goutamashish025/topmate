<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'services_in_week', 'time_slots'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
