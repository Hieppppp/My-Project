<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\Course\CourseServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
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
        $courses = $this->service->getAll(9);
        return view('client.home.body', compact('courses',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = $this->service->find($id);
        return view('client.course.detail', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
