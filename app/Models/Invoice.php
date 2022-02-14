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
      ];
      protected $casts = [
        'image' => 'json'
        ];
}
