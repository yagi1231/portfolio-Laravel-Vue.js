<?php

namespace App\Http\Requests\Search;

use App\Repositories\Search\SearchParams;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
        ];
    }

    public function getAggregateSearchParams(): SearchParams 
    {
    
        return new SearchParams(
            $this->input('name'),
            $this->input('address'),
            $this->input('tel'),
            $this->input('begin'),
            $this->input('end'),
        );
    }

    public function getSearchParams(): SearchParams 
    {
        [$begin, $end] = $this->getSearchParameter();

        return new SearchParams(
            $this->input('name'),
            $this->input('address'),
            $this->input('tel'),
            $begin,
            $end,
        );
    }

    public function getSearchParameter()
    {
        $begin = empty($this->query()) ? (new Carbon)->subDays(5) : new Carbon($this->query['begin']);
        $end = empty($this->query()) ? (new Carbon) : new Carbon($this->query['end']);

        return [$begin,  $end];
    }
}
