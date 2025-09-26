<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class RolesController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::with(['permissions'])->get();

        return view('admin.roles.index', ['roles' => $roles]);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        return view('admin.roles.create', ['permissions' => $permissions]);
    }

    public function store(StoreRoleRequest $request)
    {
        $role = Role::create($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function edit(Role $role): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::pluck('title', 'id');

        $role->load('permissions');

        return view('admin.roles.edit', ['permissions' => $permissions, 'role' => $role]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        abort_if(Gate::denies('role_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->load('permissions');

        return view('admin.roles.show', ['role' => $role]);
    }

    public function destroy(Role $role): \Illuminate\Http\RedirectResponse
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role->delete();

        return back();
    }
}
