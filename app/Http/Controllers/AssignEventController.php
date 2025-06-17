<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventsItems;
use App\Models\User;
use App\Models\Item;
use Illuminate\Http\Request;
use Auth;
use App\Notifications\AssignEvent;

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
    public function show(Request $request, $id)
    {
        $data = Event::find($id);
        if($data->user_id == Auth::user()->id){
            if($request->notification_id != null){
                $notification = auth()->user()->notifications()->find($request->notification_id);
                if($notification) {
                    $notification->markAsRead();
                }
            }
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

        $step = $request->step;
        if($step == 0){
            $data = Event::find($id);
            if($data->user_id == Auth::user()->id){
                $data->status = $request->status;
                $data->save();

                $messages["id"] = $data->id;
                $messages["url"] = route('events.show', $data->id);
                $messages["title"] = 'Event Updated';
                $messages["message"] = "{$data->name} - has been updated";
                
                $data = User::where('status', 0)->with("roles")->whereHas("roles", function($q) {
                    $q->whereIn("name", ["admin"]);
                })->get();
                foreach($data as $key => $value){
                    $value->notify(new AssignEvent($messages));
                }

                return redirect()->back()->with('success', 'Event Updated Successfully');
            }else{
                return abort(404);
            }
        }else{
            $data = Event::find($id);
            $condition = $request->condition;
            $quantity = $request->quantity;
            $notes = $request->notes;
            foreach($condition as $key => $value){
                $event_item = EventsItems::find($key);
                if($condition[$key] == 2){
                    if($event_item->condition_quantity == 0){
                        Item::where('id', $event_item->item_id)->decrement('quantity', $quantity[$key]);
                    }else{
                        if($event_item->condition_quantity > $quantity[$key]){
                            $total_qty = $event_item->condition_quantity - $quantity[$key];
                            Item::where('id', $event_item->item_id)->increment('quantity', $total_qty);
                        }else{
                            $delete_item = $quantity[$key] - $event_item->condition_quantity;
                            Item::where('id', $event_item->item_id)->decrement('quantity', $delete_item);
                        }
                    }
                }
                $event_item->condition = $condition[$key];
                $event_item->condition_quantity = $quantity[$key];
                $event_item->notes = $notes[$key];
                $event_item->save();
            }

            if($request->hasFile('image')){
                $images = $request->image;
                foreach($images as $key => $value){
                    $event_item = EventsItems::find($key);
                    $imageName = time().'-'.$key.'.'.$value->extension();
                    $value->move(public_path('images'), $imageName);
                    $event_item->image = 'images/'.$imageName;
                    $event_item->save();
                }
            }
            
            return redirect()->back()->with('success', 'Event Items Updated Successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
    }

}
