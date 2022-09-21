<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationrequest;
use App\Service\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReservationController extends Controller
{
    private ReservationService $reservationService;


    public function __construct(
        ReservationService $reservationService
    )
    {
        $this->reservationService = $reservationService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $reservation = $this->reservationService->featchAllReservation(false);
        return view('reservations.index', ['reservation' => $reservation]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationrequest $request): RedirectResponse
    {
        DB::transaction(function() use($request) {
             $reservayion = $this->reservationService->storeReservation($request->getReservationParams());
             return $reservayion;
        });

        return redirect()->route('reservation/index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        $getReservation = $this->reservationService->findReservation($id);
        return view('reservations.edit', ['reservation' => $getReservation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReservationrequest $request, int $id): RedirectResponse
    {
        $getReservation = $this->reservationService->findReservation($id);
        DB::transaction(function() use($request, $getReservation ) {
            $reservation = $this->reservationService->updateReservation($request->getReservationParams(), $getReservation);
            return $reservation;
        });

        return redirect()->route('reservation/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): RedirectResponse
    {
        $getReservation = $this->reservationService->findReservation($id);
        $this->reservationService->deletetReservation($getReservation);

        return redirect()->route('reservation/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function restore(int $id)　 
    // {
    //     $getReservation = $this->reservationService->findReservation($id);
    //     $this->reservationService->restoreReservation($getReservation);
    // }
}
