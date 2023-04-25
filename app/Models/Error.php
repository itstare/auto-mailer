<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;

    protected $fillable = ['email_id', 'error_msg', 'session_id'];

    public function session() {
    	return $this->belongsTo(Session::class);
    }

    public function email() {
    	return $this->belongsTo(Email::class);
    }
}
