<?php
declare(strict_types=1);

namespace App\Service;

use App\Repositories\Reservation\ReservationParams;

interface ReservationService 
{
     /**
     * 丸々
     */
    public function featchAllReservation(bool $withtranshed);

    /**
     * 
     */
    public function findReservation(int $reservation_id);

    /**
     * 
     */
    public function storeReservation(ReservationParams $params);

     /**
     * 
     */
    public function updateReservation(ReservationParams $params, $reservation);

    /**
     * 
     */
    public function deletetReservation($reservation);

    /**
     * 削除した予約情報を復元させる
     */
    // public function restoreReservation($reservation): void;
}
?>