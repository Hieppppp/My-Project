<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseIndexRequest;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Requests\File\FileUploadRequest;
use App\Imports\CoursesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Course\CourseServiceInterface;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CourseController extends Controller
{
    public $user;
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public CourseServiceInterface $courseService
    ) {
        
    }

    /**
     * index
     * @return Factory|View
     */
    public function index(): Factory|View
    {
        $courses = $this->courseService->getCourse();
        return view('admin.courses.index', compact('courses'));
        
    }
    /**
     * create
     * 
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        
        return view('admin.courses.create');
    }
    /**
     * store
     * 
     * @param CreateCourseRequest $request
     * @return Redirector|RedirectResponse
     */
    public function store(CreateCourseRequest $request): Redirector|RedirectResponse
    {
       
        $params = $request->validated();
        $this->courseService->create($params);
        return redirect()->route('courses.index')->with('sms', 'Course created successfully.');
    }
    /**
     * show
     *
     * @param  int $id
     * @return Factory|View
     */
    public function show(int $id): Factory|View
    {
       
        $course = $this->courseService->find($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * edit
     *
     * @param  int $id
     * @return Factory|View
     */
    public function edit(int $id): Factory|View
    {
       
        $course = $this->courseService->find($id);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * update
     *
     * @param  UpdateCourseRequest $request
     * @param  int $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateCourseRequest $request, int $id): Redirector|RedirectResponse
    {
        
        $params = $request->validated();
        $this->courseService->update($id, $params);
        return redirect()->route('courses.index')->with('sms', 'Course updated successfully.');
    }

    /**
     * destroy course
     *
     * @param  int $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(int $id): Redirector|RedirectResponse
    {
        
        $this->courseService->delete($id);
        return redirect()->back()->with('sms', 'Course deleted successfully.');
    }

    /**
     * export
     *
     * @return void
     */
    public function export()
    {
        
        return Excel::download($this->courseService->export(), 'course.xlsx');
    }

    /**
     * import
     * 
     * @param FileUploadRequest $request
     * @return Redirector
     */
    public function import(FileUploadRequest $request): Redirector|RedirectResponse
    {
        try {
            $validatedData = $request->validated();
            $file = $validatedData['file'];
            $import = new CoursesImport;

            Excel::import($import, $file);
            if ($import->failures()->isNotEmpty()) {
                return redirect()->back()->withFailures($import->failures());
            }

            return redirect()->back()->with('sms', 'Excel file uploaded!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', 'Error: ' . $th->getMessage());
        }
    }
    
    /**
     * deleteMultiRecord
     *
     * @param  Request $request
     * @return Redirector|RedirectResponse
     */
    public function deleteMultiRecord(Request $request): Redirector|RedirectResponse
    {
        
        $ids = $request->input('ids', []);

        if ($this->courseService->deleteMultiRecord($ids))
        {
            return redirect()->back()->with('sms', 'Course deleted successfully.');
        }

        return redirect()->back()->with('sms', 'Failed to delete courses.');

    }
    
    
}
