<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'order_id',
        'client_id',
        'note',
        'status',
        'image'
      ];
      protected $casts = [
        'image' => 'json'
        ];
       public function order()
        {
            return $this->belongsTo(Order::class);
        }
        public function user()
        {
            return $this->belongsTo(User::class);
        }
        public function client()
        {
            return $this->belongsTo(Client::class);
          }
}
