<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CreateCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Exports\CoursesExport;
use App\Imports\CoursesImport;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(10);
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
        $course = Course::create($request->validated());

        $course = new Course();
        $course->name = $request->name;
        $course->description = $request->description;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->save();
        return redirect()->route('courses.index')->with('sms', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, string $id)
    {
        $course = Course::findOrFail($id);
        $course->update($request->validated());
        
        return redirect()->route('courses.index')->with('sms', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);

        $course->delete();

        return redirect()->route('courses.index')->with('sms', 'Course deleted successfully.');
    }

    public function export()
    {
        return Excel::download(new CoursesExport, 'courses.xlsx');
    }

    public function import(Request $request)
    {
        Excel::import(new CoursesImport, $request->file('file'));

        return redirect()->back()->with('sms', 'Courses Imported Successfully');
    }
}
