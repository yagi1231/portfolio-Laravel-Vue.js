<?php

namespace App\Repositories\Customer;

use App\Models\Customer;
use App\Models\Reservation;
use App\Repositories\Customer\CustomerParams;
use App\Service\CustomerService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements CustomerService
{

    public function featchAllCustomer(bool $withtranshed, $search)
    {
        return Customer::query()
            ->when($withtranshed, fn(Builder $q) => $q->withTrashed())
            ->where(function($q) use ($search) {
                if($search['name'] || $search['address'] || $search['tel']) {
                    $q->where('name', $search['name'])
                    ->orwhere('address', $search['address'])
                    ->orwhere('address', $search['tel']);
                }
            })
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

    public function getOrderDayAndCount($customer, bool $withtranshed): array
    {
        $orderCount = $customer->reservations
        ->when($withtranshed, fn(Builder $q) => $q->withtranshed())
        ->where('begin', '<', Carbon::now())
        ->count();

        $lastOrderDay = $customer->reservations
        ->when($withtranshed, fn(Builder $q) => $q->withtranshed())
        ->where('begin', '<', Carbon::now())
        ->sortByDesc('begin')
        ->pluck('begin')
        ->first();

        return [$lastOrderDay, $orderCount];
    }
}
