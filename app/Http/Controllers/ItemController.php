<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Auth;

class ItemController extends Controller
{
    
    function __construct(){
        $this->middleware('permission:item|create item|edit item|delete item', ['only' => ['index','show']]);
        $this->middleware('permission:create item', ['only' => ['create','store']]);
        $this->middleware('permission:edit item', ['only' => ['edit','update']]);
        $this->middleware('permission:delete item', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Item::where('status', 0)->get();
        return view('item.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'shelf' => 'required',
            'row' => 'required',
            'image' => 'required',
        ]);
        $data = new Item();
        $data->name = $request->name;
        $data->quantity = $request->quantity;
        $data->location = $request->location;
        $data->shelf = $request->shelf;
        $data->row = $request->row;
        $data->user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data->image = 'images/'.$imageName;
        }
        $data->save();
        return redirect()->back()->with('success', 'Item Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Item::find($id);
        return view('item.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'location' => 'required',
            'shelf' => 'required',
            'row' => 'required',
        ]);
        $data = Item::find($id);
        $data->name = $request->name;
        $data->quantity = $request->quantity;
        $data->location = $request->location;
        $data->shelf = $request->shelf;
        $data->row = $request->row;
        if($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data->image = 'images/'.$imageName;
        }
        $data->save();
        return redirect()->back()->with('success', 'Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Item::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->back()->with('success', 'Item Deleted Successfully');
    }

    public function itemList(Request $request){
        $q = $request->q;
        $data = Item::where('name', 'like', '%' . $q . '%')->get();
        return response()->json($data);
    }
}
