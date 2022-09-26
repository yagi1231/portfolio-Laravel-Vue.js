<?php

namespace App\Repositories\Search;

class SearchParams
{
   private ?string $name;
   private ?string $address;
   private ?string $tel;
   private ?string $begin;
   private ?string $end;

   public function __construct(
      ?string $name,
      ?string $address,
      ?string $tel,
      ?string $begin,
      ?string $end
   )
   {
      $this->name = $name;
      $this->address = $address;
      $this->tel = $tel;
      $this->begin = $begin;
      $this->end = $end;

   }

    public function toArray() 
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'tel' => $this->tel,
            'begin' => $this->begin,
            'end' => $this->end,
        ];
    }

}
