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
    public function findReservation(int $reservationId);

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
    public function deletetReservation($reservationId);

    /**
     * 削除した予約情報を復元させる
     */
    // public function restoreReservation($reservation): void;

    /**
     * customerからの情報を一つ一つの変数に格納する
     */
    public function getCustomerInfomation($reservation);
}
?>