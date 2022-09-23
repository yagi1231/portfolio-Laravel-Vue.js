<?php

namespace App\Http\Requests\Customers;

use App\Models\Reservation;
use App\Repositories\Customer\CustomerParams;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string'],
            'remarks' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function getCustomerParams(): CustomerParams
    {
        return new CustomerParams(
            $this->input('name'),
            $this->input('address'),
            $this->input('tel'),
            $this->input('remarks'), 
        );
    }
}
