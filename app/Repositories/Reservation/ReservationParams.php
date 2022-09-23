<?php

namespace App\Repositories\Reservation;

use Illuminate\Support\Facades\Auth;

class ReservationParams
{
   private string $name;
   private string $address;
   private string $tel;
   private string $order;
   private string $sumprice;
   private string $time;
   private int $customer_id;

   public function __construct(
      string $name,
      string $address,
      string $tel,
      string $order,
      string $sumprice,
      string $time,
      int $customer_id
   )
   {
      $this->name = $name;
      $this->address = $address;
      $this->tel = $tel;
      $this->order = $order;
      $this->sumprice = $sumprice;
      $this->time = $time;
      $this->customer_id = $customer_id;
   }

    public function toArray() 
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'tel' => $this->tel,
            'order' => $this->order,
            'sumprice' => $this->sumprice,
            'staff_id' => Auth::user()->id,
            'time' => $this->time,
            'customer_id' => $this->customer_id,
        ];
    }

}
