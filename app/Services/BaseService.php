<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
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
    ) {
    }

    /**
     * paginate
     *
     * @param  array|null $params
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator
    {
        return $this->repository->paginate($params);
    }
}
