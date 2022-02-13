<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'note',
        'user_id',
        'client_name',
        'email',
        'phon_no',
        'name',
        'description',
        'image' ,
      ];
      protected $casts = [
        'image' => 'json'
        ];
      public $timestamps = true;

      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
