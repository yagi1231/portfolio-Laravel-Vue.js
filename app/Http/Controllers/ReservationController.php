<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Service\ReservationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        return view('reservations.index')->with([
            'reservation' => $reservation
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request): View
    {
        [$customerId, $customerName, $customerAddress, $customerTel, $customerRemarks] = $this->reservationService->getCustomerInfomation($request);
        
        return view('reservations.create')->with([
             'customerId'=> $customerId,
             'customerName' => $customerName,
             'customerAddress' => $customerAddress,
             'customerTel' => $customerTel,
             'customerRemarks' => $customerRemarks
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        DB::transaction(function() use ($request) {
             $reservayion = $this->reservationService->storeReservation($request->getReservationParams());
             return $reservayion;
        });

        return redirect()
            ->route('reservation/index');
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

        return view('reservations.edit')->with([
            'reservation' => $getReservation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreReservationRequest $request, int $id): RedirectResponse
    {
        $getReservation = $this->reservationService->findReservation($id);
        DB::transaction(function() use ($request, $getReservation ) {
            $reservation = $this->reservationService->updateReservation($request->getReservationParams(), $getReservation);
            return $reservation;
        });

        return redirect()
            ->route('reservation/index');
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

        return redirect()
            ->route('reservation/index');
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
