<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

class EmployeeController extends Controller
{

    function __construct(){
        $this->middleware('permission:employee|create employee|edit employee|delete employee', ['only' => ['index','show']]);
        $this->middleware('permission:create employee', ['only' => ['create','store']]);
        $this->middleware('permission:edit employee', ['only' => ['edit','update']]);
        $this->middleware('permission:delete employee', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('status', 0)->with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["employee"]);
        })->get();
        return view('employee.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $data = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        $data->assignRole('employee');
        return redirect()->back()->with('success', 'Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('employee.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if($request->password != null){
            $data->password = Hash::make($request->password);
        }
        $data->save();
        return redirect()->back()->with('success', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = User::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Employee Deleted Successfully');
    }
}
