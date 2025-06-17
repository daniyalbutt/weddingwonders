<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsItems;
use App\Models\User;
use App\Models\Item;
use App\Models\Template;
use App\Models\TemplateItems;
use Illuminate\Http\Request;
use Auth;
use App\Notifications\AssignEvent;

class EventController extends Controller
{
    function __construct(){
        $this->middleware('permission:event|create event|edit event|delete event', ['only' => ['index','show']]);
        $this->middleware('permission:create event', ['only' => ['create','store']]);
        $this->middleware('permission:edit event', ['only' => ['edit','update']]);
        $this->middleware('permission:delete event', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::orderBy('id', 'desc')->get();
        return view('event.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $template = null;
        if($request->id != null){
            $template = Template::find($request->id);
        }
        $employees = User::where('status', 0)->with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["employee"]);
        })->get();
        $items = Item::where('status', 0)->get();
        return view('event.create', compact('employees', 'items', 'template'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'venue' => 'required',
            'user_id' => 'required',
            'items' => 'required',
        ]);
        
        $data = new Event();
        $data->name = $request->name;
        $data->event_date = $request->date;
        $data->venue = $request->venue;
        $data->assign_id = Auth::user()->id;
        $data->user_id = $request->user_id;
        $data->save();

        $items = $request->items;
        foreach($items as $key => $value){
            if($value['quantity'] != null){
                $event_item = new EventsItems();
                $event_item->event_id = $data->id;
                $event_item->item_id = $value['item'];
                $event_item->quantity = $value['quantity'];
                $event_item->save();
            }
        }

        $old_items = $request->old_items;
        $old_quantity = $request->old_quantity;

        if($old_items != null){
            foreach($old_items as $key => $value){
                $event_item = new EventsItems();
                $event_item->event_id = $data->id;
                $event_item->item_id = $key;
                $event_item->quantity = $old_quantity[$key];
                $event_item->save();
            }
        }
        

        $template = $request->template;
        if($template == 1){
            $data_template = new Template();
            $data_template->name = $request->name;
            $data_template->event_date = $request->date;
            $data_template->venue = $request->venue;
            $data_template->assign_id = $data->assign_id;
            $data_template->save();
            foreach($items as $key => $value){
                $template_item = new TemplateItems();
                $template_item->template_id = $data_template->id;
                $template_item->item_id = $value['item'];
                $template_item->quantity = $value['quantity'];
                $template_item->save();
            }
        }
        $messages["id"] = $data->id;
        $messages["url"] = route('event.show', $data->id);
        $messages["title"] = 'Event Assigned';
        $messages["message"] = "{$data->name} - has assigned to you";

        
        $user = User::find($data->user_id);
        $user->notify(new AssignEvent($messages));

        return redirect()->back()->with('success', 'Event Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Event::find($id);
        return view('event.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $employees = User::where('status', 0)->with("roles")->whereHas("roles", function($q) {
            $q->whereIn("name", ["employee"]);
        })->get();
        $items = Item::where('status', 0)->get();
        $data = Event::find($id);
        return view('event.edit', compact('data', 'employees', 'items'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'venue' => 'required',
            'user_id' => 'required',
        ]);
        $data = Event::find($id);
        $data->name = $request->name;
        $data->event_date = $request->date;
        $data->venue = $request->venue;
        $data->user_id = $request->user_id;
        $data->save();

        $items = $request->items;

        if($items != null){
            foreach($items as $key => $value){
                if($value['quantity'] != null){
                    $event_item = new EventsItems();
                    $event_item->event_id = $data->id;
                    $event_item->item_id = $value['item'];
                    $event_item->quantity = $value['quantity'];
                    $event_item->save();
                }
            }
        }

        $old_items = $request->old_quantity;
        foreach($old_items as $key => $value){
            $event_item = EventsItems::find($key);
            $event_item->quantity = $value;
            $event_item->save();
        }

        return redirect()->back()->with('success', 'Event Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::find($id);
        return redirect()->back()->with('success', 'Event Deleted Successfully');
    }

    public function deleteEventItem(Request $request){
        $id = $request->id;
        EventsItems::find($id)->delete();
        return response()->json([ 'status' => true]);
    }
}
