<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\CreatePermissionRequest;
use App\Http\Requests\Permission\PermissionIndexRequest;
use App\Http\Requests\Permission\UpdatePermissionRequest;
use App\Services\Permission\PermissionServiceInterface;
use Illuminate\Console\View\Components\Factory;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PermissionController extends Controller
{
    public function __construct(
        public PermissionServiceInterface $permissionService
    ) {
    }
    /**
     * index
     *
     * @return Factory|View
     */
    public function index(PermissionIndexRequest $request): Factory|View
    {
       
        $validated = $request->validated();
        $searchKeyword = $validated['keywords'] ?? null;
        $itemsPerPage = $validated['per_page'] ?? 10;
        $permissions = $this->permissionService->pagination($searchKeyword, $itemsPerPage);
        return view('admin.permission.index', compact('permissions', 'itemsPerPage'));
    }

    /**
     * create
     *
     * @return Factory|View
     */
    public function create(): Factory|View
    {
        
        
        return view('admin.permission.create');
    }


    /**
     * store
     *
     * @param  CreatePermissionRequest $request
     * @return Redirector|RedirectResponse 
     */
    public function store(CreatePermissionRequest $request): Redirector|RedirectResponse 
    {
       
        $params = $request->validated();
        $this->permissionService->create($params);
        return redirect()->route('permissions.index')->with('sms', 'Permission created successfully.');
    }


    /**
     * show
     *
     * @param  string $id
     * @return Factory|View
     */
    public function show(string $id): Factory|View
    {
        

        $permission = $this->permissionService->findById($id);
        return view('admin.permission.show', compact('permission'));
    }

       
    /**
     * edit
     *
     * @param  string $id
     * @return Factory|View
     */
    public function edit(string $id): Factory|View
    {
        
        $permissions = $this->permissionService->findById($id);
        return view('admin.permission.edit', compact('permissions'));
    }



    /**
     * update
     *
     * @param  UpdatePermissionRequest $request
     * @param  string $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdatePermissionRequest $request, string $id): Redirector|RedirectResponse
    {
       
        $params = $request->validated();
        $this->permissionService->update($id, $params);
        return redirect()->route('permissions.index')->with('sms', 'Permission updated successfully.');
    }

    /**
     * destroy
     *
     * @param  string $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(string $id): Redirector|RedirectResponse
    {
        
        
        $this->permissionService->delete($id);
        return redirect()->back()->with('sms', 'Permission deleted successfully.');
    }
    
    /**
     * activate
     *
     * @param  int $id
     * @return Redirector
     */
    public function activate(int $id): Redirector|RedirectResponse
    {
      
        $this->permissionService->active($id);
        return redirect()->back()->with('sms', 'Permission activated successfully.');
    }
    
    /**
     * deactivate
     *
     * @param  int $id
     * @return Redirector
     */
    public function deactivate(int $id): Redirector|RedirectResponse
    {
       
        $this->permissionService->inactive($id);
        return redirect()->back()->with('sms', 'Permission deactivated successfully.');
    }

}
