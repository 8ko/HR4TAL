<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use App\Models\Department;
use Auth;

class AppController extends Controller
{
    public function index(){
        if (Auth::check()) {
            //check if timed in
            $log = Log::whereRaw('DATE(time_in) = DATE(NOW())')
                    ->where('employee_id',Auth::user()->employee_id)
                    ->first();
            $timeout = $log != null;
            $isTimedOut = $log && $log->time_out != null;

            // $user = User::where('employee_id', $employee_id)->firstOrFail();
            $depts = Department::all();
            $departments = [];
            foreach($depts as $d){
                $departments[$d->id] = $d->name;
            }

            // dd(Auth::user()->roles->first()->display_name);
            
            if (Auth::user()->hasRole('admin')){
                return view('admin.dashboard', compact('timeout','isTimedOut','departments'));
            } elseif(Auth::user()->hasRole('engr')){
                return view('engr.dashboard', compact('timeout','isTimedOut','departments'));
            } elseif(Auth::user()->hasRole('hr')){
                return view('hr.dashboard', compact('timeout','isTimedOut','departments'));
            } elseif(Auth::user()->hasRole('user')){
                return view('user.dashboard', compact('timeout','isTimedOut','departments'));
            }
        }
        
        return view('auth.login');
    }
}
