<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistido extends Model
{
    protected $table = 'assistidos';
    use HasFactory;
    public function agenda(){
    return $this->hasMany('App\Models\Agenda');
    }
    public function agendamento(){
        return $this->hasMany('App\Models\Agendamento');
    }
    
}
