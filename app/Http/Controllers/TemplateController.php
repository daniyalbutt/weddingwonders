<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\TemplateItems;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Auth;

class TemplateController extends Controller
{
    function __construct(){
        $this->middleware('permission:template|create template|edit template|delete template', ['only' => ['index','show']]);
        $this->middleware('permission:create template', ['only' => ['create','store']]);
        $this->middleware('permission:edit template', ['only' => ['edit','update']]);
        $this->middleware('permission:delete template', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Template::orderBy('id', 'desc')->get();
        return view('template.index', compact('data'));
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
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Template::find($id);
        return view('template.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Template::find($id);
        $data->name = $request->name;
        $data->event_date = $request->date;
        $data->venue = $request->venue;
        $data->save();

        $items = $request->items;
        foreach($items as $key => $value){
            if($value['quantity'] != null){
                $template_item = new TemplateItems();
                $template_item->event_id = $data->id;
                $template_item->item_id = $value['item'];
                $template_item->quantity = $value['quantity'];
                $template_item->save();
            }
        }

        $old_quantity = $request->old_quantity;
        foreach($old_quantity as $key => $value){
            $template_item = TemplateItems::find($key);
            $template_item->quantity = $value;
            $template_item->save();
        }
        
        return redirect()->back()->with('success', 'Template Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Template::find($id)->delete();
        return redirect()->back()->with('success', 'Template Deleted Successfully');
    }

    public function deleteTemplateItem(Request $request){
        $id = $request->id;
        TemplateItems::find($id)->delete();
        return response()->json([ 'status' => true]);
    }
    
}
