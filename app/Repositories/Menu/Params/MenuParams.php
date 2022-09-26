<?php

namespace App\Repositories\Menu\Params;

class MenuParams
{
   private string $name;
   private int $price;
   private string $allergy;
   private string $image;

   public function __construct(
      string $name,
      string $price,
      string $allergy,
      string $image
   )
   {
      $this->name = $name;
      $this->price = $price;
      $this->allergy = $allergy;
      $this->image = $image;
   }

    public function toArray() 
    {
        return [
            'name' => $this->name,
            'price' => $this->price,
            'allergy' => $this->allergy,
            'image' => $this->image
        ];
    }
}
