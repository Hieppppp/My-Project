<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Course\CourseServiceInterface;

class CourseController extends Controller
{
    public function __construct(
        public CourseServiceInterface $service
    )
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = $this->service->getAll(10);
        return view('admin.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCourseRequest $request)
    {
        $params = $request->validated();
        $course = $this->service->create($params);
        $course->save();
        return redirect()->route('courses.index')->with('sms', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = $this->service->find($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = $this->service->find($id);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {
        $params = $request->validated();
        $this->service->update($id, $params);
        return redirect()->route('courses.index')->with('sms', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);
        return redirect()->back()->with('sms', 'Course deleted successfully.');
    }

    public function export()
    {
        return Excel::download($this->service->export(), 'course.xlsx');
    }

    public function import(Request $request)
    {
        $this->service->import($request->file('file'));
        return redirect()->back()->with('sms', 'Courses Imported Successfully');
    }
}
