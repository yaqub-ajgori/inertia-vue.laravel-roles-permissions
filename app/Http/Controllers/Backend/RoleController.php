<?php

namespace App\Http\Controllers\Backend;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Requests\RolesStoreRequest;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Backend/Roles/Index', [
            'roles' => RoleResource::collection(Role::all())
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Backend/Roles/Create', [
            'permissions' => PermissionResource::collection(Permission::all()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RolesStoreRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
        ]);

        if ( $request->has('permissions') ){
            $role->syncPermissions($request->input('permissions.*.name'));
        }

        return to_route('roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $role = Role::findById($id);
        $role->load('permissions');

        return Inertia::render('Backend/Roles/Edit', [
                    'role' => $role,
                    'permissions' => PermissionResource::collection(Permission::all())
                ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RolesStoreRequest $request, string $id)
    {
        $role = Role::findById($id);
        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->input('permissions.*.name'));

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findById($id);
        $role->delete();
        return to_route('roles.index');
    }
}
