<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Auth;

class VenueController extends Controller
{

    function __construct(){
        $this->middleware('permission:venue|create venue|edit venue|delete venue', ['only' => ['index','show']]);
        $this->middleware('permission:create venue', ['only' => ['create','store']]);
        $this->middleware('permission:edit venue', ['only' => ['edit','update']]);
        $this->middleware('permission:delete venue', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Venue::where('status', 0)->get();
        return view('venue.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:venues',
        ]);
        $data = new Venue();
        $data->name = $request->name;
        $data->user_id = Auth::user()->id;
        $data->save();
        return redirect()->back()->with('success', 'Venue Created Successfully');
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
        $data = Venue::find($id);
        return view('venue.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:venues,name,'.$id,
        ]);
        $data = Venue::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->back()->with('success', 'Venue Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Venue::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Venue Deleted Successfully');
    }
}
