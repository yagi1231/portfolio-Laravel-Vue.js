<?php

namespace App\Repositories\Reservation;

use Illuminate\Support\Facades\Auth;

class ReservationParams
{
   private string $name;
   private string $address;
   private string $tel;
   private string $order;
   private string $status;
   private string $sumprice;
   private string $begin;
   private string $end;
   private ?string $remarks;
   private ?int $customer_id;

   public function __construct(
      string $name,
      string $address,
      string $tel,
      string $order,
      string $status,
      string $sumprice,
      string $begin,
      string $end,
      ?string $remarks,
      ?int $customer_id = null
   )
   {
      $this->name = $name;
      $this->address = $address;
      $this->tel = $tel;
      $this->order = $order;
      $this->status= $status;
      $this->sumprice = $sumprice;
      $this->begin = $begin;
      $this->end = $end;
      $this->remarks = $remarks;
      $this->customer_id = $customer_id;
   }

    public function toArray() 
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'tel' => $this->tel,
            'order' => $this->order,
            'status' => $this->status,
            'sumprice' => $this->sumprice,
            'staff_id' => Auth::user()->id,
            'begin' => $this->begin,
            'end' => $this->end,
            'remarks' => $this->remarks,
            'customer_id' => $this->customer_id
        ];
    }

}
