<?php

namespace App\Repositories\Course;

use App\Exports\CoursesExport;
use App\Imports\CoursesImport;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(Course::class);
    }

    /**
     * searchCourse
     *
     * @param  mixed $keyword
     * @param  mixed $perPage
     * @return mixed
     */
    /**
     * getAll
     *
     * @param  mixed $perPage
     * @return void
     */
    public function getAll(int $perPage)
    {
        return Course::paginate($perPage);
    }

    /**
     * create
     *
     * @param  mixed $course
     * @return Course
     */
    public function create(array $course): Course
    {
        return Course::create([
            'name' => $course['name'],
            'description' => $course['description'],
            'start_date' => $course['start_date'],
            'end_date' => $course['end_date'],
        ]);
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

        $results = Course::findOrFail($id);
        if ($results) {
            $results->update($course);
            return $results;
        }
        return false;
    }

    /**
     * find
     *
     * @param  mixed $id
     * @return void
     */
    public function find($id)
    {
        return Course::findOrFail($id);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $course = Course::findOrFail($id);

        return $course->delete();
    }

    public function searchCourse($keyword, int $perPage): mixed
    {
        return Course::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->paginate($perPage);
    }

    /**
     * export
     *
     * @return CoursesExport
     */
    public function export(): CoursesExport
    {
        return new CoursesExport();
    }

    /**
     * import
     *
     * @param  mixed $file
     * @return void
     */
    public function import($file): void
    {
        Excel::import(new CoursesImport, $file);
    }
}
