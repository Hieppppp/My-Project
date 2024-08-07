<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\UserIndexRequest;
use App\Models\User;
use App\Services\Course\CourseServiceInterface;
use App\Services\Role\RoleServiceInterface;
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
        public UserServiceInterface $userService,
        public CourseServiceInterface $courseService,
        public RoleServiceInterface $roleService
    ) {
        $this->middleware('check-ownership')->only(['edit', 'update']);
    }
    
    /**
     * index
     * @return Factory
     */
    public function index(): Factory|View
    {
        
        $users = $this->userService->getUser();
        return view('admin.users.index', compact('users'));
        
    }
   
    /**
     * create
     *
     * @param  User $user
     * @return Factory
     */
    public function create(User $user): Factory|View
    {
        $roles = $this->roleService->getRole()->where('status', 1);
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
    
    /**
     * deleteMultiRecord
     *
     * @param  Request $request
     * @return Redirector|RedirectResponse
     */
    public function deleteMultiRecord(Request $request): Redirector|RedirectResponse
    {
        $ids = $request->input('ids', []);

        if ($this->userService->deleteMultiRecord($ids))
        {
            return redirect()->back()->with('sms', 'Users deleted successfully.');
        }

        return redirect()->back()->with('sms', 'Failed to delete users.');

    }

    
    /**
     * showLinkRequestForm
     *
     * @return Factory
     */
   
}
