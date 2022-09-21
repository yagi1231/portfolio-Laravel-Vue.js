<?php

namespace App\Repositories;

use App\Models\Reservation;
use App\Repositories\Reservation\ReservationParams;
use App\Service\ReservationService;
use Illuminate\Database\Eloquent\Builder;

class ReservationRepository implements ReservationService
{

    public function featchAllReservation(bool $withtranshed)
    {
        return Reservation::query()
               ->when($withtranshed, fn(Builder $q) => $q->withTrashed())
               ->paginate(5);
    }

    public function findReservation(int $reservation_id)
    {
        return Reservation::find($reservation_id);
    }

    public function storeReservation(ReservationParams $params)
    {
        return Reservation::create($params->toArray());
    }

    public function updateReservation(ReservationParams $params, $reservation)
    {
        $reservation->update($params->toArray());
        return $reservation;
    }

    public function deletetReservation($reservation)
    {
        $reservation->delete();
    }

    // public function restoreReservation($reservation): void
    // {
    //     $reservation->restore();
    // }
}
