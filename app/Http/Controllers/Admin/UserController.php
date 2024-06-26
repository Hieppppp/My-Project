<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Course;
use App\Services\User\UserServiceInterface;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public UserServiceInterface $service
    ) {
    }
    
    /**
     * index
     * 
     * @param Request $request
     * @return Factory
     */
    public function index(Request $request): Factory|View
    {
        $keyword = $request->input('keywords');
        $users = $this->service->pagination($keyword, 10);
        return view('admin.users.index', compact('users'));
    }
    
    /**
     * create user
     *
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        $courses = $this->service->getAllCourse();
        return view('admin.users.create', compact('courses'));
    }

    /**
     * store user
     * 
     * @param CreateUserRequest $request
     * @return Redirector
     */
    public function store(CreateUserRequest $request): Redirector|RedirectResponse
    {
        $params = $request->validated();
        $user = $this->service->create($params);
        if ($request->has('courses')) {
            $user->courses()->attach($request->input('courses'));
        }
        return redirect()->route('users.index')->with('sms', 'User created successfully.');
    }

    /**
     * show user
     *
     * @param  string $id
     * @return Factory|View
     */
    public function show(string $id): Factory|View
    {
        $users = $this->service->find($id);
        return view('admin.users.show', compact('users'));
    }

    /**
     * edit user
     * 
     * @param string $id
     * @return Factory|View
     */
    public function edit(string $id): Factory|View
    {
        $users = $this->service->find($id);
        $courses = Course::all();
        $selectedCourses = $users->courses->pluck('id')->toArray();
        return view('admin.users.edit', compact('users', 'courses', 'selectedCourses'));
    }

    /**
     * create user
     * 
     * @param UpdateUserRequest $request
     * @param string $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateUserRequest $request, string $id): Redirector|RedirectResponse
    {
       
        $user = $request->validated();
        $courseIds = $request->input('courses');
        $this->service->update($id, $user, $courseIds);
        return redirect()->route('users.index')->with('sms', 'User updated successfully.');
    }

    /**
     * destroy user by id
     *
     * @param  string $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(string $id): Redirector|RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->back()->with('sms', 'User deleted successfully.');
    }
}
