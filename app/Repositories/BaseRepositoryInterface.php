<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

interface BaseRepositoryInterface
{
    public function paginate(array|null $params = null): Paginator;

    
    
}
