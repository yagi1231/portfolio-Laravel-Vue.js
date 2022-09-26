<?php

namespace App\Repositories\Menu;

use App\Models\Menu;
use App\Service\CustomerParams;
use App\Service\MenuService;
use Illuminate\Database\Eloquent\Builder;
use App\Repositories\Menu\Params\MenuParams;

class MenuRepository implements MenuService
{

    public function featchAllMenu(bool $withtranshed)
    {
        return Menu::query()
               ->when($withtranshed, fn(Builder $q) => $q->withTrashed())
               ->paginate(5);
    }

    // public function findReservation(int $reservation_id)
    // {
    //     return Reservation::find($reservation_id);
    // }

    public function storeMenu(MenuParams $params)
    {
        return Menu::create($params->toArray());
    }

    // public function storeImagePhoto()
    // {
        
    // }

    // public function updateReservation(ReservationParams $params, $reservation)
    // {
    //     $reservation->update($params->toArray());
    //     return $reservation;
    // }

    // public function deletetReservation($reservation)
    // {
    //     $reservation->delete();
    // }

    // public function restoreReservation($reservation): void
    // {
    //     $reservation->restore();
    // }



}
