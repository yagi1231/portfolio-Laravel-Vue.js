<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Http\Requests\Search\SearchRequest;
use App\Service\CustomerService;
use App\Service\SeachService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private CustomerService $customerService;
    private SeachService $seachService;

    public function __construct(
        CustomerService $customerService,
        SeachService $seachService
    )
    {
        $this->customerService = $customerService;
        $this->seachService = $seachService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SearchRequest $request): View
    {
        $serach = $this->seachService->getSerachParam($request->getSearchParams()); 
        $customers = $this->customerService->featchAllCustomer(false,  $serach->toArray());
        return view('customers.index')->with([
            'customers' => $customers
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request): RedirectResponse
    {
        DB::transaction(function() use ($request) {
            $customer = $this->customerService->storeCustomer($request->getCustomerParams());
            return $customer;
        });

        return redirect()->route('customer/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $customer = $this->customerService->findCustomer($id, true);
        [$lastOrderDay , $orderCount] = $this->customerService->getOrderDayAndCount($customer, false);
        return view('customers.show')->with([
            'customer' => $customer,
            'latOrderDay' => $lastOrderDay ,
            'orderCount' => $orderCount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $customer = $this->customerService->findCustomer($id, true);
        $staffName = $customer->user->name;

        return view('customers.edit')->with([
            'customer' => $customer,
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
    public function update(StoreCustomerRequest $request, int $id)
    {
        $customer = $this->customerService->findCustomer($id, true);
        DB::transaction(function() use ($request, $customer) {
            $customer = $this->customerService->updateCustomer($request->getCustomerParams(), $customer);
            return $customer;
        });

        return redirect()
            ->route('customer/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id): RedirectResponse
    {
        $customer = $this->customerService->findCustomer($id, true, ["reservations"]);
        $this->customerService->deletetCustomer($customer);

       return redirect()
           ->route('customer/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id): RedirectResponse
    {
        $customer = $this->customerService->findCustomer($id, true, ["reservations"]);
        $this->customerService->restoreCustomer($customer);

        return redirect()
            ->route('customer/index');
    }
}
