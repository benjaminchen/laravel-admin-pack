<?php

namespace BenjaminChen\Admin\Controllers;

use Illuminate\Http\Request;
use BenjaminChen\Admin\AdminUser;
use Auth;
use Validator;

class AdminUserController extends BaseController
{
    private $authUser = null;

    public function __construct()
    {
        $this->authUser = Auth::guard('admin')->user();
    }

    public function index()
    {
        $admins = AdminUser::where('role', '>=', $this->authUser->role)->paginate(10);

        return view('adminPack::user.index', [
            'user' => $this->authUser,
            'admins' => $admins
        ]);
    }

    public function create()
    {
        return view('adminPack::user.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'username' => 'required|alpha_num|min:3|max:32',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        
        $admin = new AdminUser;
        $admin->fill($request->all());
        $admin->password = bcrypt($request->input('password'));

        return $admin->save() ? redirect("admin/manager")->with('message', trans("manager.create_success")) :
                response('Server Error!', '500');
    }

    public function edit($manager)
    {
        $admin = AdminUser::find($manager);

        if (! $admin) return response('Bad Request!', 400);

        return view('adminPack::user.update', [
            'admin' => $admin,
        ]);
    }

    public function update(Request $request, $manager)
    {
        $admin = AdminUser::find($manager);

        if (! $admin) return response('Bad Request!', 400);

        $rules = array(
            'username' => 'required|alpha_num|min:3|max:32',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();

        $admin->fill($request->all());
        if ($request->input('password')) $admin->password = bcrypt($request->input('password'));

        return $admin->save() ? redirect("admin/manager")->with('message', trans("manager.updated_success")) :
                response('Server Error!', '500');
    }

    public function destroy($manager)
    {
        $admin = AdminUser::find($manager);

        if (! $admin) return response('Bad Request!', 400);

        $result = $admin->delete();
        $message = $result ? trans("manager.delete_success") : trans("manager.delete_fail");

        return response()->json([
            'result' => $result,
            'message' => $message,
        ]);
    }
}
