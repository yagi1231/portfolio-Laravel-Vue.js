<?php

namespace App\Repositories\Search;

use App\Service\SeachService;
use Carbon\Carbon;

class SearchRepository implements SeachService
{
    public function getSerachParam($query)
    {
        return $query;
    }
}