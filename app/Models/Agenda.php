<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    
    public function user(){
		return $this->belongsTo('App\Models\User');
	}
    public function assistido(){
        return $this->belongsToMany('App\Models\Assistido');
    }
}


