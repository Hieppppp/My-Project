<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Course;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        public UserServiceInterface $service
    ){

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->service->getAll(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        return view('admin.users.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $params = $request->validated();
        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatar'), $avatarName);
            $params['avatar'] = $avatarName;
        }
        $user = $this->service->create($params);

        if ($request->has('courses')) {
            $user->courses()->attach($request->input('courses'));
        }
        return redirect()->route('users.index')->with('sms', 'User created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = $this->service->find($id);
        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = $this->service->find($id);
        $courses = Course::all();
        $selectedCourses = $users->courses->pluck('id')->toArray();
        return view('admin.users.edit', compact('users', 'courses', 'selectedCourses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) {
            $user = $this->service->find($id);
            if ($user->avatar) {
                $oldImage = public_path('avatar') .'.'. $user->avatar;
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            $avatarName = time() .'.'. $request->avatar->extension();
            $request->avatar->move(public_path('avatar'), $avatarName);
            $data['avatar'] = $avatarName;

        }
        $this->service->update($id, $data);

        if ($request->has('courses')) {
            $user = $this->service->find($id);
            $user->courses()->sync($request->input('courses'));
        }
    
        return redirect()->route('users.index')->with('sms', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);
        return redirect()->back()->with('sms', 'User deleted successfully.');
    }
}
