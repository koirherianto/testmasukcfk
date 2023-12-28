<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;
use App\Models\Permission;
use Flash;
use DB;

class PermissionController extends AppBaseController
{
    /** @var PermissionRepository $permissionRepository*/
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->middleware('permission:permission.index', ['only' => ['index','show']]);
        $this->middleware('permission:permission.create', ['only' => ['create','store']]);
        $this->middleware('permission:permission.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission.destroy', ['only' => ['destroy']]);
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the Permission.
     */
    public function index(Request $request)
    {
        $permissions = Permission::all();

        return view('permissions.index')->with('permissions', $permissions);
    }

    /**
     * Show the form for creating a new Permission.
     */
    public function create()
    {
        return view('permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     */
    public function store(CreatePermissionRequest $request)
    {
        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('Permission saved successfully.');
        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified Permission.
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->find($id);
        
        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('permissions.index'));
        }

        return view('permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('permissions.index'));
        }

        return view('permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('permissions.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('Permission updated successfully.');
        return redirect(route('permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('permissions.index'));
        }

        DB::transaction(function () use($permission){
            $permission->syncRoles([]);
            $permission->delete();
        },3);

        Flash::success('Permission deleted successfully.');
        return redirect(route('permissions.index'));
    }
}
