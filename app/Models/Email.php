<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'password', 'already_used'];

    public function isUsed() {
    	if ($this->already_used) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function errors() {
    	return $this->hasMany(Error::class);
    }
}
