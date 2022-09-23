<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Repositories\Customer\CustomerParams;
use App\Service\CustomerService;
use Illuminate\Database\Eloquent\Builder;

class CustomerRepository implements CustomerService
{

    public function featchAllCustomer(bool $withtranshed)
    {
        return Customer::query()
            ->when($withtranshed, fn(Builder $q) => $q->withTrashed())
            ->paginate(5);
    }

    public function findCustomer(int $customerId, bool $withtranshed)
    {
        return Customer::query()
            ->when($withtranshed, fn(Builder $q) => $q->withTrashed())
            ->find($customerId);
    }

    public function storeCustomer(CustomerParams $params)
    {
        return Customer::create($params->toArray());
    }

    public function updateCustomer(CustomerParams $params, $customer)
    {
        $customer->update($params->toArray());
    }

    public function deletetCustomer($customer): void
    {
        $customer->delete();
    }

    public function restoreCustomer($customer): void
    {
        $customer->restore();
    }
}
