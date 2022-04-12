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
        $user = User::where('employee_id', $employee_id)->firstOrFail();

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
    public function update(Request $request, $id)
    {
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->detachRole($user->role);
        $user->attachRole($request->user_level);
        return redirect()->back()->with('success','Account updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAccounts()
    {
        $users = User::all();
        return Datatables::of($users)
                ->addColumn('action', function ($data) {
                    return '<a href='.route(uth::user()->roles->first()->name.'.accounts.edit').' class="btn btn-info btn-sm">Edit</a>'.
                            '<a href="#" class="btn btn-danger btn-sm mx-1">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
