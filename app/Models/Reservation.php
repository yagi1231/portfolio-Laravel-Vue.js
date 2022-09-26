<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = ['token'];

    /**
     * 配達状況ステータス
     */
    public const DELIVERY_STATUS_A = 1;
    public const DELIVERY_STATUS_B = 2;
    public const DELIVERY_STATUS_C = 3;
    public const DELIVERY_STATUS_D = 4;

    public const DELIVERY_STATUS_ALL = [
        self::DELIVERY_STATUS_A,
        self::DELIVERY_STATUS_B,
        self::DELIVERY_STATUS_C,
        self::DELIVERY_STATUS_D,
    ];

    public const DELIVERY_STATUS_DISPLAY_ALL = [
        self::DELIVERY_STATUS_A => '準備中',
        self::DELIVERY_STATUS_B => '配達中',
        self::DELIVERY_STATUS_C => '配達完了',  
        self::DELIVERY_STATUS_D => '再配達',      
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
