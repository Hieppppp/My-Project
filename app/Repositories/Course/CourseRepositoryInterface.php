<?php

namespace App\Repositories\Course;


use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;

interface  CourseRepositoryInterface
{
    /**
     * getAll
     *
     * @param  mixed $perPage
     * @return void
     */
    public function getAll(int $perPage);

    /**
     * create
     *
     * @param  mixed $course
     * @return Course
     */
    public function create(array $course): Course;

    /**
     * find
     *
     * @param  mixed $id
     * @return void
     */
    public function find($id);

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $course
     * @return void
     */
    public function update($id, array $course);

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id);

    /**
     * searchCourse
     *
     * @param  mixed $keyword
     * @param  mixed $perPage
     * @return mixed
     */
    public function searchCourse($keyword, int $perPage): mixed;

    /**
     * export
     *
     * @return FromCollection
     */
    public function export(): FromCollection;

    /**
     * import
     *
     * @param  mixed $file
     * @return void
     */
    public function import($file): void;
}
