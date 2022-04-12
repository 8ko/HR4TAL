<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\EmployeeType;
use App\Models\Department;
use Auth;

class AccountController extends Controller
{
    public function index($employee_id){
        if (Auth::user()->hasRole(['engr','user']) && Auth::user()->employee_id!=$employee_id){
            abort(403,"User does not have any of the necessary access rights.");
        }

        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $types = EmployeeType::all();
        $employee_types = [];
        foreach($types as $t){
            $employee_types[$t->id] = $t->name;
        }
        $depts = Department::all();
        $departments = [];
        foreach($depts as $d){
            $departments[$d->id] = $d->name;
        }
        // dd($user);

        if (Auth::user()->hasRole('admin')){
            return view('admin.profile', compact('user','employee_types','departments'));
        } elseif(Auth::user()->hasRole('engr')){
            return view('engr.profile', compact('user','employee_types','departments'));
        } elseif(Auth::user()->hasRole('hr')){
            return view('hr.profile', compact('user','employee_types','departments'));
        } elseif(Auth::user()->hasRole('user')){
            return view('user.profile', compact('user','employee_types','departments'));
        }
    }

    public function update(Request $request, $employee_id){
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $user->employee_type = $request->employee_type;
        $user->employee_status = $request->employee_status;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->contact = $request->contact;
        $user->email_personal = $request->email_personal;
        $user->school = $request->school;
        $user->course = $request->course;
        $user->department = $request->department;
        $user->coordinator = $request->coordinator;
        $user->coordinator_email = $request->coordinator_email;
        $user->orientation_day = $request->orientation_day;
        $user->first_day = $request->first_day;
        $user->last_day = $request->last_day;
        $user->exit_day = $request->exit_day;
        $user->quota_hours = $request->quota_hours;
        $user->save();
        return redirect()->back()->with('success','Changes saved.');
    }

    public function register(Request $request){
        $user = new User;
        $user->employee_id = $request->employee_id;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->employee_id . '@roc.ph';
        $user->password = Hash::make($request->password);
        $user->save();
        $user->attachRole('user');
        return redirect()->back()->with('success','Account created.');
    }

    public function storeMedia(Request $request){
        $path = storage_path('tmp/uploads');
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }
        $file = $request->file('file');
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function uploadAvatar(Request $request, $employee_id){
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        if($request->hasFile('avatar') && $request->file('avatar')->isValid()){
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }
        return redirect()->back()->with('success','Avatar updated.');
    }

    public function uploadRequirement(Request $request, $employee_id){
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        if(!empty($request->input('requirement_type')) && $request->hasFile('requirement') && $request->file('requirement')->isValid()){
            $user->addMediaFromRequest('requirement')->toMediaCollection($request->input('requirement_type'));
        }
        return redirect()->back()->with('success','Requirement uploaded');
    }

    public function deleteRequirement(Request $request, $employee_id){
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $file = $user->getMedia($request->input('view_type'))->last();
        if ($file) {
            $file->delete();
        }
        return redirect()->back()->with('success','Requirement deleted');
    }

    public function saveComment(Request $request, $employee_id){
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $user->comment=$request->input('comment');
        $user->save();
        return redirect()->back()->with('success','Changes saved.');
    }

    public function accounts() {
        return view('admin.accounts');
    }

    public function create() {
        return view('admin.create');
    }
}