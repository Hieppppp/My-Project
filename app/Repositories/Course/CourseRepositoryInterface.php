<?php

namespace App\Repositories\Course;


use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Concerns\FromCollection;

interface  CourseRepositoryInterface
{
   
    /**
     * @param int $perPage
     * 
     * @return Collection
     */
    public function getCourse(): Collection;
    
    /**
     * find course by id
     * 
     * @param int $id
     * 
     * @return Course|null
     */
    public function find(int $id): ?Course;
    /**
     * create
     * 
     * @param array $course
     * 
     * @return Course
     */
    public function create(array $course): Course;
    
    /**
     * update
     * 
     * @param int $id
     * @param array $course
     * 
     * @return bool
     */
    public function update(int $id, array $course): bool;

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
     * @param string|null $keyword
     * @param int $perPage
     * 
     * @return LengthAwarePaginator
     */
    public function pagination(?string $keyword, int $perPage): LengthAwarePaginator;

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
    
    /**
     * deleteByIds
     *
     * @param  array $ids
     * @return int
     */
    public function deleteByIds(array $ids): int;

    
}
