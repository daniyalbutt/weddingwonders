<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public function template_items(){
        return $this->hasMany(TemplateItems::class, 'template_id', 'id');
    }
}
