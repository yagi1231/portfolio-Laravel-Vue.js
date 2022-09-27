<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id', 'path'];

    public function item()
    {
        return $this->belongsTo('App\Menu');
    }
}
