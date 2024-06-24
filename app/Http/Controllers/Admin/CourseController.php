<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function __construct(
        public CourseServiceInterface $service
    ) {
    }
    /**
     * @return Factory|View
     */
    public function index(Request $request): Factory|View
    {
        $keyword = $request->input('keywords');
        $courses = $this->service->searchCourse($keyword, 10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        return view('admin.courses.create');
    }

    /**
     * store
     *
     * @param  mixed $request
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
     * Display the specified resource.
     */
    /**
     * show
     *
     * @param  mixed $id
     * @return Factory|View
     */
    public function show(string $id): Factory|View
    {

        $course = $this->service->find($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return Factory|View
     */
    public function edit(string $id): Factory|View
    {
        $course = $this->service->find($id);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateCourseRequest $request, string $id): Redirector|RedirectResponse
    {
        $params = $request->validated();
        $this->service->update($id, $params);
        return redirect()->route('courses.index')->with('sms', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    /**
     * destroy
     *
     * @param  mixed $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(string $id): Redirector|RedirectResponse
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
     * @param  mixed $request
     * @return Redirector|RedirectResponse
     */
    public function import(FileUploadRequest $request): Redirector|RedirectResponse
    {
        $validatedData = $request->validated();
        $file = $validatedData['file'];
        $this->service->import($file);
        return redirect()->back()->with('sms', 'Courses Imported Successfully');
    }
}
