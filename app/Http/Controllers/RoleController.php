<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Flash;
use DB;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class RoleController extends AppBaseController
{
    /** @var RoleRepository $roleRepository*/
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->middleware('permission:role.index', ['only' => ['index','show']]);
        $this->middleware('permission:role.create', ['only' => ['create','store']]);
        $this->middleware('permission:role.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role.destroy', ['only' => ['destroy']]);
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     */
    public function index(Request $request) : View
    {
        $roles = $this->roleRepository->paginate(10);

        return view('roles.index')->with('roles', $roles);
    }

    /**
     * Show the form for creating a new Role.
     */
    public function create() : View
    {
        $sPermissions = Permission::orderBy('name')->get();
        $permissions = [];

        return view('roles.create',compact('sPermissions','permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        try{
            DB::beginTransaction();

            $role = Role::create($request->all());

            if($request->has('permission_id')) {
                $permissions = Permission::whereIn('id',$request->permission_id)->get();
                $role->syncPermissions($permissions);
            }

            DB::commit();
            Flash::success('Role updated successfully.');
        }catch (Exception $e){
            DB::rollBack();
            Flash::error('Role updated not save.');
        }

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('roles.index'));
        }

        $permissions = $role->permissions ? $role->permissions->pluck('name','id') : [];

        return view('roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified Role.
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $sPermissions=Permission::orderBy('name')->get();
        $permissions=$role->permissions->pluck('id')->toArray();

        return view('roles.edit',compact('sPermissions', 'permissions'))->with('role', $role);
    }

    /**
     * Update the specified Role in storage.
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('role.index'));
        }

        try{
            DB::beginTransaction();
            
            $role->update($request->all());

            if($request->has('permission_id')){
                $permissions = Permission::whereIn('id',$request->permission_id)->get();
                $role->syncPermissions($permissions);
            }

            DB::commit();
            Flash::success('Role updated successfully.');
        }catch (Exception $e){
            DB::rollBack();
            Flash::error('Role updated not save.');
        }
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');
            return redirect(route('roles.index'));
        }

        DB::transaction(function () use($role,$id){
            $role->permissions()->detach();
            $role->users()->detach();
            $this->roleRepository->delete($id);
        }, 3);

        Flash::success('Role deleted successfully.');
        return redirect(route('roles.index'));
    }
}
