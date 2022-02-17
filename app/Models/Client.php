<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'phon_no',
        'name',
        'address',
      ];
      protected $casts = [
        'image' => 'json'
        ];
      public $timestamps = true;

       public function orders()
       {
          return $this->hasMany(Order::class);
        }
        public function posts()
        {
           return $this->hasMany(Post::class);
         }
}
