<?php

namespace App\Services\Course;

use App\Exports\CoursesExport;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

/**
 * [Description CourseService]
 */
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
     * get all course
     * 
     * @param int $parPage
     * 
     * @return Collection
     */
    public function getAll(int $parPage): Collection|Paginator
    {
        return $this->repository->getAll($parPage);
    }

    /**
     * find course by id
     * 
     * @param int $id
     * @return Course|null
     */
    public function find(int $id): ?Course
    {
        return $this->repository->find($id);
    }

    /**
     * create
     * 
     * @param array|null|null $params
     * 
     * @return Course
     */
    public function create(array|null $params = null): Course
    {
        return $this->repository->create($params);
    }

    /**
     * update course
     * 
     * @param int $id
     * @param array $course
     * 
     * @return Course
     */
    public function update(int $id, array $course): Course
    {
        return $this->repository->update($id, $course);
    }

    /**
     * delete course
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
 
    /**
     * search course
     * 
     * @param string|null $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator
    {
        return $this->repository->pagination($keyword, $perPage);
    }

    /**
     * export course
     *
     * @return CoursesExport
     */
    public function export(): CoursesExport
    {
        return $this->repository->export();
    }

    /**
     * import course
     *
     * @param  mixed $file
     * @return void
     */
    public function import($file): void
    {
        $this->repository->import($file);
    }
}
