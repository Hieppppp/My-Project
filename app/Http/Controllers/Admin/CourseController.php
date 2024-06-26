<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseIndexRequest;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Requests\File\FileUploadRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Course\CourseServiceInterface;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CourseController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public CourseServiceInterface $service
    ) {
    }
    
    /**
     * index
     * 
     * @param Request $request
     * @return Factory|View
     */
    public function index(CourseIndexRequest $request): Factory|View
    {
        $keyword = $request->input('keywords');
        $courses = $this->service->pagination($keyword, 10);
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
        $course = $this->service->create($params);
        $course->save();
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
        $course = $this->service->find($id);
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
        $course = $this->service->find($id);
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
        $this->service->update($id, $params);
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
        $this->service->delete($id);
        return redirect()->back()->with('sms', 'Course deleted successfully.');
    }

    /**
     * export
     *
     * @return void
     */
    public function export()
    {
        return Excel::download($this->service->export(), 'course.xlsx');
    }
    
    /**
     * import
     * 
     * @param FileUploadRequest $request
     * @return Redirector
     */
    public function import(FileUploadRequest $request): Redirector|RedirectResponse
    {
        $validatedData = $request->validated();
        $file = $validatedData['file'];
        $this->service->import($file);
        return redirect()->back()->with('sms', 'Courses Imported Successfully');
    }
}
