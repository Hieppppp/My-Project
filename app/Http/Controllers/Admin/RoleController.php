<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\Permission\PermissionServiceInterface;
use App\Services\Role\RoleServiceInterface;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function __construct(
        public RoleServiceInterface $roleService,
        public PermissionServiceInterface $permissionService
    )
    {
        
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(403);
        }
       
        $roles = $this->roleService->getRole();
        $permissions = $this->permissionService->getPermission();
        return view('admin.role.index', compact('roles', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (! Gate::allows('users_manage')) {
            return abort(403);
        }
        $permissions = $this->permissionService->getPermission();
        return view('admin.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRoleRequest $request)
    {
        
        $data = $request->validated();
        $this->roleService->create($data);
        return redirect()->route('roles.index')->with('sms', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(403);
        }
        $roles = $this->roleService->findById($id);
        return view('admin.role.show', compact('roles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(403);
        }
        $roles = $this->roleService->findById($id);

        $permissions = $this->permissionService->getPermission();

        $selectedPermissions = $roles->permissions->pluck('id')->toArray();
        return view('admin.role.edit', compact('roles', 'permissions', 'selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
       
        $data = $request->validated();
        $this->roleService->update($id, $data);
        return redirect()->route('roles.index')->with('sms', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (! Gate::allows('users_manage')) {
            return abort(403);
        }
        $this->roleService->delete($id);
        return redirect()->back()->with('sms', 'Role deleted successfully.');
    }

    public function activate(int $id)
    {
        $this->roleService->active($id);
        return redirect()->back()->with('sms', 'Role activated successfully.');
    }

    public function deactivate(int $id)
    {
        $this->roleService->inactive($id);
        return redirect()->back()->with('sms', 'Role deactivated successfully.');
    }
}
