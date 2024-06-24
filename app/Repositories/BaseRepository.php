<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class BaseRepository implements BaseRepositoryInterface
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public string $model
    ) {
    }
 
    /**
     * paginate
     *
     * @param  mixed $params
     * @return Paginator
     */
    public function paginate(array|null $params = null): Paginator
    {
        return $this->getModel()->paginate($params);
    }
    
    /**
     * getModel
     *
     * @return Model
     */
    public function getModel(): Model
    {
        return new $this->model;
    }

   
}

