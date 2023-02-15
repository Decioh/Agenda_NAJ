<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    public function agenda()
    {
        return $this->belongsTo(Agenda::class, 'agenda_id', 'id');
    }
    use HasFactory;
}
