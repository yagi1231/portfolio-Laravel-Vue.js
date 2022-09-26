<?php

namespace App\Http\Requests\Menus;

use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\Menu\Params\MenuParams;

class StoreMenuRequest extends FormRequest
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
            'price' => ['required', 'integer', 'between:0, 9999'],
            'allergy' => ['required', 'string', 'max:255'],
        ];
    }

    public function getMenuParams(): MenuParams
    {
        return new MenuParams(
            $this->input('name'),
            $this->input('price'),
            $this->input('allergy'),
            $this->file('image')->store('public')
        );
    }
}