<?php

namespace App\Services\Course;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;

interface CourseServiceInterface
{
    /**
     * @param int $parPage
     * 
     * @return [type]
     */
    public function getAll(int $parPage);
    /**
     * @param array|null|null $params
     * 
     * @return Course
     */
    public function create(array|null $params = null): Course;

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function find($id);
    
    /**
     * @param mixed $id
     * @param array $course
     * 
     * @return bool
     */
    public function update($id, array $course);

    /**
     * @param mixed $id
     * 
     * @return [type]
     */
    public function delete($id);

    public function export():FromCollection;

    public function import($file): void;


    
}