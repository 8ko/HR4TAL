<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use App\Models\User;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->employee_id = $request->employee_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email . '@roc.ph';
        $user->password = Hash::make($request->password);
        $user->save();
        $user->attachRole($request->user_level);
        return redirect()->back()->with('success','Account created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($employee_id)
    {
        $user = User::select('users.*', 'roles.id as role_id', 'roles.name as role_name')
                    ->join('role_user', 'role_user.user_id', '=', 'users.id')
                    ->join('roles', 'role_user.role_id', '=', 'roles.id')
                    ->where('employee_id', $employee_id)->firstOrFail();

        if (Auth::user()->hasRole('admin')){
            return view('admin.accounts.edit', compact('user'));
        } elseif(Auth::user()->hasRole('engr')){
            return view('engr.accounts.edit', compact('user'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employee_id)
    {
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->detachRole($user->role);
        $user->attachRole($request->role_name);
        return redirect()->back()->with('success','Account updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employee_id)
    {
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $user->delete();
        return redirect()->back()->with('success','Account deleted.');
    }

    public function restore($employee_id)
    {
        $user = User::withTrashed()->where('employee_id', $employee_id)->firstOrFail();
        $user->restore();
        return redirect()->back()->with('success','Account restored.');
    }

    public function getAccounts()
    {
        $users = User::withTrashed();
        return Datatables::of($users)
                ->addColumn('action', function ($data) {
                    $btn = '<a href='.route(Auth::user()->roles->first()->name.'.accounts.edit', $data->employee_id).' class="btn btn-primary btn-sm">Edit</a>';
                    if (empty($data->deleted_at)) {
                        $btn .= '<a href='.route(Auth::user()->roles->first()->name.'.accounts.destroy', $data->employee_id).' class="btn btn-danger btn-sm mx-1">Delete</a>'.
                                '<a class="btn btn-success btn-sm disabled">Restore</a>';
                    } else {
                        $btn .= '<a class="btn btn-danger btn-sm mx-1 disabled">Delete</a>'.
                                '<a href='.route(Auth::user()->roles->first()->name.'.accounts.restore', $data->employee_id).' class="btn btn-success btn-sm">Restore</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
