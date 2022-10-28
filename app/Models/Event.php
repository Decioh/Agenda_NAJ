<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	use HasFactory;

	protected $fillable = [
		'title', 'start', 'end'
	];

	public function user(){
		return $this->belongsTo('App\models\user');
	}
}

?>
