<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function total_quantity(){
        $id = $this->id;
        $event_item = EventsItems::where('item_id', $id)->get();
        $event_qty = 0;
        foreach($event_item as $key => $value){
            if($value->event->status == 0){
                $event_qty += $value->quantity;
            }
        }
        $total_qty = $this->quantity - $event_qty;
        return $total_qty;
    }
}
