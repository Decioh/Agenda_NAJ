<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    
    public function assistido(){
        return $this->belongsTo('App\Models\Assistido','assistido_id');
    }
    public function assistidoAgenda(){
        return $this->hasMany('App\Models\AssistidoAgenda','assistido_id');
        }
    public function user(){
		return $this->belongsTo('App\Models\User');
	}

}


