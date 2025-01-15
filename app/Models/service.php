<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = ['user_id','name','description','rating','price','time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
