<?php

declare(strict_types=1);
 
namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Admin\Entities\Role;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect; 
use Route;
use Validator;
use View;
use Illuminate\Support\Facades\Input;

/**
 * Class AdminController
 */
class RoleController extends Controller
{
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    { 
         
        View::share('viewPage', 'role'); 
        View::share('route_url', route('role'));
        View::share('heading', 'Role');

        $this->record_per_page = Config::get('app.record_per_page');
    }
 

    /*
     * Dashboard
     * */

    public function index(Role $role, Request $request)
    {
        $page_title  = 'Role';
        $page_action = 'View Role';

        $role_type  = ['developer','admin','user'];
 

        // Search by name ,email and group
        $search = Input::get('search');

        if ((isset($search) && !empty($search))) {
            $search = isset($search) ? Input::get('search') : '';

            $role = Role::where(function ($query) use ($search) {
                if (!empty($search)) {
                    $query->Where('name', 'LIKE', "%$search%");
                }
            })->orderBy('name', 'asc')->Paginate($this->record_per_page);
        } else {
            $role  = Role::orderBy('id', 'asc')->get();
        }

        return view('admin::role.index', compact('role','role_type', 'page_title', 'page_action'));
    }

    /*
     * create  method
     * */

    public function create(Role $role)
    { 
        $page_title  = 'Role';
        $page_action = 'Create Role';
        $role_type  = ['developer','admin','user'];

        return view('admin::role.create', compact('role', 'role_type','page_title', 'page_action'));
    }

    /*
     * Save Group method
     * */

    public function store(Request $request, Role $role)
    {

        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'role_type'  => 'required|unique:roles,name'
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $role->type         =   $request->get('role_type');
        $role->name         =   $request->get('name');
        $role->slug         =   $request->get('name');
        $role->description  =   $request->get('description');
        $role->permissions   = json_encode($request->get('permission'));
        $role->save();

        return Redirect::to('o4k/roles')
            ->with('flash_alert_notice', 'Role was successfully created !');
    }
    /*
     * Edit Group method
     * @param
     * object : $category
     * */

    public function edit(Request $request, $role)
    { 
        $page_title  = 'Role';
        $page_action = 'Edit Role';
        $role_type  = ['developer','admin','user'];

        if(!empty($role->permissions)){
            $permissions =  json_decode($role->permissions);
        }else{
            $permissions =  [];
        }

        return view('admin::role.edit', compact('role','permissions' ,'role_type','page_title', 'page_action'));
    }

    public function update(Request $request,  $role)
    {
        $validator = Validator::make($request->all(), [
            'name'       => 'required',
            'role_type'  => 'required'
        ]);
        /** Return Error Message */
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $role->type         =   $request->get('role_type');
        $role->name         =   $request->get('name');
        $role->slug         =   $request->get('name');
        $role->description  =   $request->get('description');
        $role->permissions   = json_encode($request->get('permission'));
        $role->save();

        $role->save();

        return Redirect::to('o4k/roles')
            ->with('flash_alert_notice', 'Role was successfully updated!');
    }
    /*
     *Delete User
     * @param ID
     *
     */
    public function destroy(Request $request,  $role)
    {
        $role->delete();

        return Redirect::to('o4k/roles')
            ->with('flash_alert_notice', 'Role was successfully deleted!');
    }

    public function show(Role $role)
    {
    }

    public function permission(Request $request, Permission $premission)
    {
        $page_title  = 'Permission';
        $page_action = 'Update Permission';

        if ($request->method() == 'GET') {
            $roles = Role::all();

            return view('roles::role.permission', compact('roles', 'page_title', 'page_action'));
        }

        if ($request->method() == 'POST') {
            $permission = $request->get('permission');
            foreach ($permission as $role_id => $controllers) {
                $role             = Role::find($role_id);
                $role->permission = json_encode($controllers);
                $role->modules    = null;
                $role->save();
            }

            return Redirect::to('admin/permission')
                ->with('flash_alert_notice', 'Permission was successfully changed!');
        }
    }
}
