<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\Paginator;

class BaseService implements BaseServiceInterface
{
    public function __construct(
        public BaseRepository $repository
    ){
    }

    public function paginate(array|null $params = null): Paginator
    {
        return $this->repository->paginate($params);
    }

    
}