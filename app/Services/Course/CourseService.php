<?php

namespace App\Services\Course;

use App\Exports\CoursesExport;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Services\BaseService;


class CourseService extends BaseService implements CourseServiceInterface
{
    

    public function __construct(
        public BaseRepository $repository
    ) {
        parent::__construct($repository);
    }

    /**
     * @param int $parPage
     * 
     * @return [type]
     */
    public function getAll(int $parPage)
    {
        return $this->repository->getAll($parPage);
    }

    /**
     * @param array|null|null $params
     * 
     * @return Course
     */
    public function create(array|null $params = null): Course
    {
        return $this->repository->create($params);
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param mixed $id
     * @param array $course
     * 
     * @return bool
     */
    public function update($id, array $course)
    {
        return $this->repository->update($id, $course);
    }

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function export(): CoursesExport
    {
        return $this->repository->export();
    }

    public function import($file): void
    {
        $this->repository->import($file);
    }




   
}
