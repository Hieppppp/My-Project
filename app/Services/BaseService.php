<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\Paginator;

class BaseService implements BaseServiceInterface
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public BaseRepository $repository
    ){
    }
    
    /**
     * paginate
     *
     * @param  mixed $params
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator
    {
        return $this->repository->paginate($params);
    }

    
}