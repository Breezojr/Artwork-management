<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_number',
        'user_id',
        'artwork_id',
        'order_id',
        'created_date'
      ];
      protected $casts = [
        'image' => 'json'
        ];
        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function client()
        {
            return $this->belongsTo(Client::class);
          }

        public function order()
        {
            return $this->belongsTo(Order::class);
          }
          public function post()
          {
              return $this->belongsTo(Post::class);
            }
  }
