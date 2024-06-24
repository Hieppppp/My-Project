<?php

namespace App\Services\Course;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

interface CourseServiceInterface
{
    
    /**
     * get all course
     * 
     * @param int $parPage
     * 
     * @return Collection
     */
    public function getAll(int $parPage): Collection|Paginator;
    
    /**
     * create course
     * 
     * @param array|null|null $params
     * 
     * @return Course
     */
    public function create(array|null $params = null): Course;

   
    /**
     * find course by id
     * 
     * @param int $id
     * 
     * @return Course|null
     */
    public function find(int $id): ?Course;

    
    /**
     * update course
     * 
     * @param int $id
     * @param array $course
     * 
     * @return Course
     */
    public function update(int $id, array $course): Course;

   
   
    /**
     * delete course
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * search course
     * 
     * @param string $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function searchCourse($keyword, int $perPage): LengthAwarePaginator;

    /**
     * export course
     *
     * @return FromCollection
     */
    public function export(): FromCollection;

    /**
     * import course
     *
     * @param  mixed $file
     * @return void
     */
    public function import($file): void;
}
