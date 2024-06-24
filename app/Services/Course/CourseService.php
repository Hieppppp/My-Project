<?php

namespace App\Services\Course;

use App\Exports\CoursesExport;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Services\BaseService;


class CourseService extends BaseService implements CourseServiceInterface
{


    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public BaseRepository $repository
    ) {
        parent::__construct($repository);
    }
    /**
     * getAll
     *
     * @param  mixed $parPage
     * @return void
     */
    public function getAll(int $parPage)
    {
        return $this->repository->getAll($parPage);
    }


    /**
     * create
     *
     * @param  mixed $params
     * @return Course
     */
    public function create(array|null $params = null): Course
    {
        return $this->repository->create($params);
    }


    /**
     * find
     *
     * @param  mixed $id
     * @return void
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $course
     * @return void
     */
    public function update($id, array $course)
    {
        return $this->repository->update($id, $course);
    }


    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * searchCourse
     *
     * @param  mixed $keyword
     * @param  mixed $perPage
     * @return mixed
     */
    public function searchCourse($keyword, int $perPage): mixed
    {
        return $this->repository->searchCourse($keyword, $perPage);
    }

    /**
     * export
     *
     * @return CoursesExport
     */
    public function export(): CoursesExport
    {
        return $this->repository->export();
    }

    /**
     * import
     *
     * @param  mixed $file
     * @return void
     */
    public function import($file): void
    {
        $this->repository->import($file);
    }
}
