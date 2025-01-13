<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class About extends Model
{
    use HasFactory;

    protected $table = 'about'; // 
    protected $fillable = ['user_id','profile_picture', 'about', 'linkedin', 'x', 'instagram', 'portfolio_website'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
