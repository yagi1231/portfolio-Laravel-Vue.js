<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Reservation\StoreReservationRequest;
use App\Http\Requests\Search\SearchRequest;
use App\Service\ReservationService;
use App\Service\SeachService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReservationController extends Controller
{
    private ReservationService $reservationService;
    private SeachService $seachService;

    public function __construct(
        ReservationService $reservationService,
        SeachService $seachService
    )
    {
        $this->reservationService = $reservationService;
        $this->seachService = $seachService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request): View
    {
        $serach = $this->seachService->getSerachParam($request->getAggregateSearchParams()); 
        $reservation = $this->reservationService->featchAllReservation(false, $serach->toArray());

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
        $reservation = $this->reservationService->findReservation($id);
        $staffName = $reservation->user->name;

        return view('reservations.edit')->with([
            'reservation' => $reservation,
            'staffName' => $staffName
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
    // public function restore(int $id): void
    // {
    //     $getReservation = $this->reservationService->findReservation($id);
    //     $this->reservationService->restoreReservation($getReservation);
    // }

    public function daysum(Request $request)
    {
        $serachAggregate = $this->reservationService->getDaySumAndAvg($request->query());

        return view('aggregate.daysum')->with([
            'serachAggregate' => $serachAggregate
        ]);
    }
}
