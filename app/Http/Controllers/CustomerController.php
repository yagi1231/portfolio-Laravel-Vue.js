<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\StoreCustomerRequest;
use App\Service\CustomerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(
        CustomerService $customerService
    )
    {
        $this->customerService = $customerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $customers = $this->customerService->featchAllCustomer(false);
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
        return view('customers.show')->with([
            'customer' => $customer
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
        return view('customers.edit')->with([
            'customer' => $customer
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
        $customer = $this->customerService->findCustomer($id, true);
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
        $customer = $this->customerService->findCustomer($id, true);
        $this->customerService->restoreCustomer($customer);

        return redirect()
            ->route('customer/index');
    }
}
