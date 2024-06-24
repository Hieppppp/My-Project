<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Pagination\Paginator;

interface BaseRepositoryInterface
{    
    /**
     * paginate
     *
     * @param  mixed $params
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator;

    
    
}
