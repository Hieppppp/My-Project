<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PermissionName;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\UserIndexRequest;
use App\Models\User;
use App\Services\Course\CourseServiceInterface;
use App\Services\Role\RoleServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Auth\Access\Gate;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        public UserServiceInterface $userService,
        public CourseServiceInterface $courseService,
        public RoleServiceInterface $roleService
    ) {
    }
    
    /**
     * index
     * 
     * @param UserIndexRequest $request
     * @return Factory
     */
    public function index(UserIndexRequest $request): Factory|View
    { 
        $validatedData = $request->validated();
        $searchKeyword = $validatedData['keywords'] ?? null;
        $itemsPerPage = $validatedData['per_page'] ?? 10;
        $users = $this->userService->pagination($searchKeyword, $itemsPerPage);
        return view('admin.users.index', compact('users', 'itemsPerPage'));
    }
       
    /**
     * create
     *
     * @param  User $user
     * @return Factory
     */
    public function create(User $user): Factory|View
    {
        $roles = $this->roleService->getRole();
        $courses = $this->courseService->getCourse();
        return view('admin.users.create', compact('roles', 'courses'));
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
        $this->userService->create($params);
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
        $users = $this->userService->find($id);
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
        $users = $this->userService->find($id);
        $courses = $this->courseService->getCourse();
        $roles = $this->roleService->getRole();
        $selectedCourses = $users->courses->pluck('id')->toArray();
        $selectedRoles = $users->roles->pluck('id')->toArray();
        return view('admin.users.edit', compact('users', 'courses', 'roles', 'selectedCourses', 'selectedRoles'));
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
        $userData = $request->validated();
        $this->userService->update($id, $userData,);
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
       
        $this->userService->delete($id);
        return redirect()->back()->with('sms', 'User deleted successfully.');
    }
}
