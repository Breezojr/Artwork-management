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
        'title',
        'description',
        'price',
        'status',
      ];
    
      public $timestamps = true;

       public function users()
       {
          return $this->belongsToMany(User::class);
        }

        public function invoices()
        {
           return $this->hasMany(Invoice::class);
         }

      public function client()
      {
          return $this->belongsTo(Client::class);
        }

        


}
