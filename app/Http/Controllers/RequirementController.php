<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RequirementController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $employee_id)
    {
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        if(!empty($request->input('requirement_type')) && $request->hasFile('requirement') && $request->file('requirement')->isValid()){
            $user->addMediaFromRequest('requirement')->toMediaCollection($request->input('requirement_type'));
        }
        return redirect()->back()->with('success','Requirement uploaded');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $employee_id)
    {
        $user = User::where('employee_id', $employee_id)->firstOrFail();
        $file = $user->getMedia($request->input('view_type'))->last();
        if ($file) {
            $file->delete();
        }
        return redirect()->back()->with('success','Requirement deleted');
    }
}
