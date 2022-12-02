<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistido extends Model
{
    use HasFactory;
    public function agendamento(){
    return $this->hasMany('App\Models\Agendamento');
    }
}
