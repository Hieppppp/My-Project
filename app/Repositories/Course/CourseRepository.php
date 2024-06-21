<?php

namespace App\Repositories\Course;

use App\Exports\CoursesExport;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Imports\CoursesImport;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Facades\Excel;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Course::class);
    }

    public function getAll(int $perPage)
    {
        return Course::paginate($perPage);
    }

    public function create(array $course): Course
    {
        return Course::create([
            'name' => $course['name'],
            'description' => $course['description'],
            'start_date' => $course['start_date'],
            'end_date' => $course['end_date'],
        ]);
    }

    public function update($id, array $course)
    {
        
        $results = Course::findOrFail($id);
        if ($results) {
            $results->update($course);
            return $results;
        }
        return false;
    }

    public function find($id)
    {
        return Course::findOrFail($id);
    }

    public function delete($id)
    {
        $course = Course::findOrFail($id);

        return $course->delete();
    }

    public function export(): CoursesExport
    {
        return new CoursesExport();
    }

    public function import($file): void
    {
        Excel::import(new CoursesImport, $file);
    }
    
}