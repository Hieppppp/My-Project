<?php

namespace App\Repositories\Course;

use App\Exports\CoursesExport;
use App\Imports\CoursesImport;
use App\Models\Course;
use App\Repositories\BaseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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
     * getCourse
     *
     * @return Collection
     */
    public function getCourse(): Collection
    {
        return Course::all();
    }

    /**
     * find course by id
     * 
     * @param int $id
     * 
     * @return Course|null
     */
    public function find(int $id): ?Course
    {
        return Course::findOrFail($id);
    }

    /**
     * create
     * 
     * @param array $course
     * 
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
     * @param int $id
     * @param array $course
     * 
     * @return bool
     */
    public function update(int $id, array $course): bool
    {
        $results = Course::findOrFail($id);
        return $results->update($course);
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
        $course = Course::findOrFail($id);

        return $course->delete();
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
        return Course::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('description', 'like', '%' . $keyword . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate($perPage);
    }

    /**
     * export course
     *
     * @return CoursesExport
     */
    public function export(): CoursesExport
    {
        return new CoursesExport();
    }

    /**
     * import course
     *
     * @param  mixed $file
     * @return void
     */
    public function import($file): void
    {
        Excel::import(new CoursesImport, $file);
    }
}
