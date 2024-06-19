<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('courses')->paginate(10);
        return view('admin.users.index', compact('users'));
        // $users = User::paginate(5);
        // return (new UserResourceCollection($users))->response();
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
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatar'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

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
        $users = User::with('courses')->findOrFail($id);
        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::findOrFail($id);
        $courses = Course::all();

        $selectedCourses = $users->courses->pluck('id')->toArray();
        return view('admin.users.edit', compact('users', 'courses', 'selectedCourses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                $oldAvatarPath = public_path('avatar') . '.' . $user->avatar;
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath);
                }
            }

            $avatarName = time() . '.' . $request->avatar->extension();
            $request->avatar->move(public_path('avatar'), $avatarName);
            $data['avatar'] = $avatarName;
        }

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        else {
            unset($data['password']);
        }

        $user->update($data);

        if ($request->has('courses')) {
            $user->courses()->sync($request->input('courses'));
        }

        return redirect()->route('users.index')->with('sms', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);

        if ($users->avatar) {
            $avatarPath = public_path('avatar') . '/' . $users->avatar;
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }

            $users->delete();
            return redirect()->route('users.index')->with('sms', 'User deleted successfully.');
        }
    }
}
