<?php
namespace App\Repositories\Course;


use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;

interface  CourseRepositoryInterface 
{
    public function getAll(int $perPage);
    
    public function create(array $course): Course;

    public function find($id);

    public function update($id, array $course);

    public function delete($id);

    public function export(): FromCollection;

    public function import($file): void;


}
