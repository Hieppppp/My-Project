<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

interface BaseServiceInterface
{
    /**
     * paginate
     *
     * @param  array|null $params
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator;
}
