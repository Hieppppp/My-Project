<?php

namespace App\Repositories;

use Illuminate\Pagination\Paginator;

interface BaseRepositoryInterface
{
    /**
     * paginate
     *
     * @param  array|null $params
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator;
}
