<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Auth;
use DB;
use Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use ValidatesRequests;
    // function __construct()
    // {
    //      $this->middleware('permission:admin-list|admin-create|admin-edit|admin-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:admin-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:admin-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:admin-delete', ['only' => ['destroy']]);
    // 	 $this->middleware('permission:admin-status', ['only' => ['status']]);
    // }

    public function ShowLoginForm()
    {
        return view('backend.auth.login');
    }

    public function loginPost(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Admin::where('email', $request->email)->first();
            $token = $user->createToken('PICG')->plainTextToken;
            session(['api_auth_token' => $token]);
            if (Auth::guard('admin')->user()->isactive == 1) {
                return redirect()->route('manager.dashboard')->with('success', 'Admin Login Successfully');
            } else {
                Auth::guard('admin')->logout();
                session()->forget('api_auth_token');

                return redirect()->route('manager.login')->with('error', 'Automatically Logout You Are Not Active User Please contact to Administrator');
            }
        }

        return redirect()->route('manager.login')->with('error', 'This credentials is incorrect');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->forget('api_auth_token');

        return redirect()->route('manager.login')->with('success', 'Admin has been logged out!');
    }

    public function index(Request $request): View
    {
        $data = Admin::latest()->get();

        return view('backend.authentication.admins.index', compact('data'));
    }

    public function create(): View
    {
        $user = Auth::guard('admin')->user();
        $roles = Role::when(! $user->hasRole('Super Admin'), function ($query) {
            $query->where('name', '!=', 'Super Admin');
        })->orderBy('id', 'DESC')->pluck('name', 'name')->all();

        return view('backend.authentication.admins.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = Admin::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('manager.users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id): View
    {
        $user = Admin::find($id);

        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        try {
            $row_id = decrypt($id);
            $admin = Admin::findOrFail($row_id);
            $roles = Role::where('guard_name', 'admin')->pluck('name', 'name')->all();

            return view('backend.authentication.admins.edit', compact('admin', 'roles'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'user_code' => 'required|unique:admins,user_code,'.$id,
            'email' => 'required|email|unique:admins,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required',
        ]);
        $input = $request->all();
        if (! empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }
        $admin = Admin::find($id);
        $admin->update($input);
        DB::table('model_has_roles')->where('model_type', 'App\Models\Admin')->where('model_id', $id)->delete();
        if (! empty($request->roles)) {
            $admin->assignRole($request->input('roles'));
        }

        return redirect()->route('manager.users.index')->with('success', 'Admin user updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        try {
            $row_id = decrypt($id);
            $admin = Admin::findOrFail($row_id);
            $admin->delete();

            return redirect()->route('manager.users.index')->with('success', 'Admin user deleted successfully');
        } catch (DecryptException $e) {
            abort(404);
        }
    }
}
