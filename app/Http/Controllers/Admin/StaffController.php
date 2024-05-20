<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Validator;
use DB;
use Session;

class StaffController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:staffs', ['only' => ['index','store','create','edit','update','destroy']]);
    }

    public function index(Request $request)
    {
        $request->session()->put('staffs_last_url', url()->full());
        $staffs = User::where('user_type','staff')->orderBy('id', 'DESC')->paginate(20);
        return view('admin.staffs.index', compact('staffs'));
    }

    public function create()
    {
        $roles = Role::where('is_active',1)->orderBy('name', 'ASC')->get()->toArray();
        return view('admin.staffs.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:confirm-password',
            'role' => 'required',
            'confirm-password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        
        $user = User::create([
            'name' => $request->name,
            'user_type' => "staff",
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);

        $user->assignRole($request->role);

        flash(translate('Staff Created Successfully!'))->success();
        return redirect()->route('staffs.index');
    }

    public function edit(User $staff)
    {
        $roles = Role::where('is_active', 1)->orderBy('name', 'ASC')->get()->toArray();
        $userRole = $staff->roles->pluck('id')->all();
        return view('admin.staffs.edit', compact('userRole', 'roles', 'staff'));
    }

    public function update(Request $request,  User $staff)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$staff->id,
            'password' => 'nullable|min:6',
            'role' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
       
        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status
        ]);

        if ($request->password) {
            $staff->password = Hash::make($request->password);
            $staff->save();
        }

        DB::table('model_has_roles')->where('model_id', $staff->id)->delete();
        $staff->assignRole($request->role);

        flash(translate('Staff has been updated successfully'))->success();
        $url = Session::has('staffs_last_url') ? Session::get('staffs_last_url') : route('staffs.index') ;
        return redirect($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->delete();

        flash(translate('User has been deleted.'))->error();
        $url = Session::has('staffs_last_url') ? Session::get('staffs_last_url') : route('staffs.index') ;
        return redirect($url);
    }
}
