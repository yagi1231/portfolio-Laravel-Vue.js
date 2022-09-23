<?php

namespace App\Repositories\Customer;

use Illuminate\Support\Facades\Auth;

class CustomerParams
{
   private string $name;
   private string $address;
   private string $tel;
   private ?string $remarks;

   public function __construct(
      string $name,
      string $address,
      string $tel,
      string $remarks = null
   )
   {
      $this->name = $name;
      $this->address = $address;
      $this->tel = $tel;
      $this->remarks = $remarks;
   }

    public function toArray() 
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'tel' => $this->tel,
            'remarks' => $this->remarks,
            'staff_id' => Auth::user()->id,
        ];
    }

}
