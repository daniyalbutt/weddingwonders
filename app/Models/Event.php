<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function event_items(){
        return $this->hasMany(EventsItems::class, 'event_id', 'id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function get_status(){
        if($this->status == 0){
            return 'In progress';
        }
    }

    public function get_status_class(){
        if($this->status == 0){
            return 'bg-primary-600';
        }
    }


}
