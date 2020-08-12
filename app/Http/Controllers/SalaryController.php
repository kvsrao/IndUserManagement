<?php

namespace App\Http\Controllers;

use App\Salary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = User::with('salary')->find($id);
        // return $user;
        return view('salary',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$eid)
    {

        $request->validate([
            'gsalary' =>  ['required', 'numeric'],
            'pf' =>  ['required', 'numeric', 'max:100,min:0'],
            'esi' =>  ['required', 'numeric', 'max:100,min:0'],
            'tds' =>  ['required', 'numeric', 'max:100,min:0'],
        ]);

        $data = [
            // 'user_id' => $eid,
            'gsalary' => $request->gsalary,
            'pf' => $request->pf,
            'esi' => $request->esi,
            'tds' => $request->tds,
            'nsalary' => $request->gsalary  - ( ($request->gsalary * $request->pf/100 ) + ($request->gsalary * $request->esi/100 ) + ($request->gsalary * $request->tds/100 ) ),

        ];
        $salary = Salary::updateOrCreate(['user_id' => $eid],$data);
        if($salary){Session::flash('pmessage', 'User Salary Particulars Added/Updated Successfully, User Id '.$salary->id); }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Salary $salary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        //
    }
}
