<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Log;
use DB;
use Auth;

class LogController extends Controller
{
    public function index(){
        $logs = User::select('users.*','departments.name','logs.time_in','logs.time_out', DB::raw('timestampdiff(hour, logs.time_in, logs.time_out) as rendered'))
                    ->join('logs','logs.employee_id','=','users.employee_id')
                    ->join('departments','users.department','=','departments.id')
                    ->get();

        if (Auth::user()->hasRole('admin')){
            return view('admin.logs', compact('logs'));
        } elseif(Auth::user()->hasRole('engr')){
            return view('engr.logs', compact('logs'));
        } elseif(Auth::user()->hasRole('hr')){
            return view('hr.logs', compact('logs'));
        } elseif(Auth::user()->hasRole('user')){
            return view('user.logs', compact('logs'));
        }
    }

    public function timein(){
        $user = User::find(Auth::user()->id);
        $log = new Log;
        $log->first_name = $user->first_name;
        $log->last_name = $user->last_name;
        $log->employee_id = $user->employee_id;
        $log->time_in = Carbon::now();
        $log->save();
        return Redirect::route('home');
    }

    public function timeout(){
        $log = Log::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->first();
        $log->time_out = Carbon::now();
        $log->save();
        return Redirect::route('home');
    }
}
