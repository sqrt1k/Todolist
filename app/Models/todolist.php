<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
     protected $fillable = ['title', 'completed','dayofweek', 'user_id'];
     
     public function user()
     {
          return $this->belongsTo(User::class);
     }
}
