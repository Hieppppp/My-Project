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
    public function __construct(
        public UserServiceInterface $service
    ) {
    }
    /**
     * index
     *
     * @return Factory|View
     */
    public function index(Request $request): Factory|View
    {
        $keyword = $request->input('keywords');
        $users = $this->service->searchUser($keyword, 10);
        return view('admin.users.index', compact('users'));
    }
    /**
     * create
     *
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        $courses = Course::all();
        return view('admin.users.create', compact('courses'));
    }
    /**
     * Store a newly created resource in storage.
     */
    /**
     * store
     *
     * @param  mixed $request
     * @return Redirector|RedirectResponse
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
     * show
     *
     * @param  mixed $id
     * @return Factory|View
     */
    public function show(string $id): Factory|View
    {
        $users = $this->service->find($id);
        return view('admin.users.show', compact('users'));
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(string $id): Factory|View
    {
        $users = $this->service->find($id);
        $courses = Course::all();
        $selectedCourses = $users->courses->pluck('id')->toArray();
        return view('admin.users.edit', compact('users', 'courses', 'selectedCourses'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateUserRequest $request, string $id): Redirector|RedirectResponse
    {
        $user = $request->validated();

        if ($request->hasFile('avatar')) {
            $user['avatar'] = $request->file('avatar');
        }
        $this->service->update($id, $user);

        if ($request->has('courses')) {
            $this->service->syncCourses($id, $request->input('courses'));
        }

        return redirect()->route('users.index')->with('sms', 'User updated successfully.');
    }
    /**
     * destroy
     *
     * @param  mixed $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(string $id): Redirector|RedirectResponse
    {
        $this->service->delete($id);
        return redirect()->back()->with('sms', 'User deleted successfully.');
    }
}
