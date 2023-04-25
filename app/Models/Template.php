<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Template extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'last_used'];

    public function lastTimeUsed() {
    	if(empty($this->last_used)) {
    		return 'Not used';
    	} else {
    		$date = new Carbon($this->last_used);
    		return $date->diffForHumans();
    	}
    }
}
