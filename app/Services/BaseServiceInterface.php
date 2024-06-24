<?php
namespace App\Services;

use Illuminate\Pagination\Paginator;

interface BaseServiceInterface
{
    
    /**
     * paginate
     * @param array|null|null $params
     * 
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator;

}