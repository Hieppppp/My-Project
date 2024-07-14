<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleServiceInterface;
use Carbon\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function __construct(
        public RoleServiceInterface $roleService,
        public PermissionServiceInterface $permissionService,
        
    )
    {
        
    }
      
    /**
     * index
     *
     * @return Factory
     */
    public function index(): Factory|View
    {
        
       
        $roles = $this->roleService->getRole();
        $permissions = $this->permissionService->getPermission();
        return view('admin.role.index', compact('roles', 'permissions'));
    }

       
    /**
     * create
     *
     * @return Factory
     */
    public function create(): Factory|View
    {
        
        $permissions = $this->permissionService->getPermission();
        return view('admin.role.create', compact('permissions'));
    }

      
    /**
     * store
     *
     * @param  CreateRoleRequest $request
     * @return Redirector
     */
    public function store(CreateRoleRequest $request): Redirector|RedirectResponse
    {
        
        $data = $request->validated();
        $this->roleService->create($data);
        return redirect()->route('roles.index')->with('sms', 'Role created successfully.');
    }
  
    /**
     * show
     *
     * @param  string $id
     * @return Factory
     */
    public function show(string $id): Factory|View
    {
        
        $roles = $this->roleService->findById($id);
        return view('admin.role.show', compact('roles'));
    }

  
    /**
     * edit
     *
     * @param  string $id
     * @return Factory|View
     */
    public function edit(string $id): Factory|View
    {
       
        $roles = $this->roleService->findById($id);

        $permissions = $this->permissionService->getPermission();

        $selectedPermissions = $roles->permissions->pluck('id')->toArray();
        return view('admin.role.edit', compact('roles', 'permissions', 'selectedPermissions'));
    }

     
    /**
     * update
     *
     * @param  UpdateRoleRequest $request
     * @param  string $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateRoleRequest $request, string $id): Redirector|RedirectResponse
    {
       
        $data = $request->validated();
        $this->roleService->update($id, $data);
        return redirect()->route('roles.index')->with('sms', 'Role updated successfully.');
    }
    
    /**
     * destroy
     *
     * @param  string $id
     * @return Redirector
     */
    public function destroy(string $id): Redirector|RedirectResponse
    {
        
        $this->roleService->delete($id);
        return redirect()->back()->with('sms', 'Role deleted successfully.');
    }    
    /**
     * activate
     *
     * @param  int $id
     * @return Redirector|RedirectResponse
     */
    public function activate(int $id): Redirector|RedirectResponse
    {
        $this->roleService->active($id);
        return redirect()->back()->with('sms', 'Role activated successfully.');
    }
    
    /**
     * deactivate
     *
     * @param  int $id
     * @return Redirector|RedirectResponse
     */
    public function deactivate(int $id): Redirector|RedirectResponse
    {
        $this->roleService->inactive($id);
        return redirect()->back()->with('sms', 'Role deactivated successfully.');
    }
}
