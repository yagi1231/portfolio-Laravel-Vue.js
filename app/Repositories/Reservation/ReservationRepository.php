<?php

namespace App\Repositories\Reservation;

use App\Models\Reservation;
use App\Repositories\Reservation\ReservationParams;
use App\Service\ReservationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ReservationRepository implements ReservationService
{

    public function featchAllReservation(bool $withtranshed, $search)
    {
        return Reservation::query()
               ->when($withtranshed, fn(Builder $q) => $q->withTrashed())
               ->where(function($q) use ($search) {
                    if(empty(request('begin')) || empty(request('end'))) {
                        $q->whereBetween('begin', [$search['begin'], $search['end']]);
                    }
                })
               ->paginate(5);
    }

    public function findReservation(int $reservation_id, array $with = [])
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


    public function getCustomerInfomation($params)
    {
        $customerId = $params->id;
        $customerName = $params->name;
        $customerAddress = $params->address;
        $customerTel = $params->tel;
        $customerRemarks = $params->remarks;

        return [ $customerId, $customerName, $customerAddress, $customerTel, $customerRemarks];
    }

    public function getDaySumAndAvg($query)
    {
        return DB::table('reservations')
            ->selectRaw('DATE_FORMAT(begin, "%Y%m%d") AS time')
            ->selectRaw('SUM(sumprice) AS day_sum')
            ->selectRaw('AVG(sumprice) AS day_avg')
            ->selectRaw('count(sumprice) AS total_count')
            ->groupBy('time')
            ->orderBy('time', 'asc')
            ->where(function($q) use ($query){
                if(!empty(request('begin') && !empty(request('end')))) {
                    $q->whereBetween("begin", [$query['begin'], $query['end']]);
                }
                elseif(!empty(request('begin') || !empty(request('end')))) {
                    $q->whereIn('begin', [$query['begin'], $query['end']]);
                }
            })
            ->simplePaginate('5');

    }
}
