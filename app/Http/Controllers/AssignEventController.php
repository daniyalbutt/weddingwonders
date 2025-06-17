<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsItems;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Auth;

class AssignEventController extends Controller
{
    function __construct(){
        $this->middleware('permission:assign-event', ['only' => ['index']]);
        $this->middleware('permission:show assign-event', ['only' => ['show']]);
        $this->middleware('permission:edit assign-event', ['only' => ['edit','update']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::where('user_id', Auth::user()->id)->get();
        return view('assign-event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Event::find($id);
        if($data->user_id == Auth::user()->id){
            return view('assign-event.show', compact('data'));
        }else{
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
    }

}
