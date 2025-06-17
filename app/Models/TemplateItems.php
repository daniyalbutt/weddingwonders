<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateItems extends Model
{
    use HasFactory;

    public function item(){
        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public function total_remaining(){
        $total_item = $this->item->quantity;
        $event_qty = 0;
        $event_item = EventsItems::where('item_id', $this->item->id)->get();
        foreach($event_item as $key => $value){
            if($value->event->status == 0){
                $event_qty += $value->quantity;
            }
        }
        $total_qty = $total_item - $event_qty;
        return $total_qty;
    }
}
