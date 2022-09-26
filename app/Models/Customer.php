<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','address','tel', 'remarks', 'staff_id'];

    public function reservations()
    {
      return $this->hasMany(reservation::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'staff_id');
    }
}
