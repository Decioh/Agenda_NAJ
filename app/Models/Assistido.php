<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistido extends Model
{
    protected $table = 'assistidos';
    use HasFactory;

    public function agenda(){
        
    return $this->hasMany('App\Models\Agenda','agenda_id');
    }
    public function assistido(){
    
    return $this->hasMany('App\Models\Assistido','assistido_id');
    }
}
