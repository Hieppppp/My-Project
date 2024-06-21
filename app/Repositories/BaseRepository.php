<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        public string $model
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
        return $this->getModel()->paginate($params);
    }

    public function getModel(): Model
    {
        return new $this->model;
    }

   
}

