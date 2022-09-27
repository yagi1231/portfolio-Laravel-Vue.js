<?php

namespace App\Http\Requests\Reservation;

use App\Models\Reservation;
use App\Repositories\Reservation\ReservationParams;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReservationRequest extends FormRequest
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
            'order' => ['required', 'string', 'max:255'],
            'sumprice' => ['required', 'integer', 'between:0,999999'],
            'time' => ['required', 'date'],
            'status' => ['integer', Rule::in(Reservation::DELIVERY_STATUS_ALL)]
        ];
    }

    public function getReservationParams(): ReservationParams
    {
        return new ReservationParams(
            $this->input('name'),
            $this->input('address'),
            $this->input('tel'),
            $this->input('order'),
            $this->input('status'),
            $this->input('sumprice'),
            $this->input('time'),
            $this->input('remarks'),
            $this->input('customer_id'),
        );
    }
}
