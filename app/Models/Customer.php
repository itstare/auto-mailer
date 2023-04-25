<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'used', 'email_list_id'];

    public function emailList() {
    	$this->belongsTo(EmailList::class);
    }

    public function sent() {
    	if($this->used) {
    		return 'Yes';
    	} else {
    		return 'No';
    	}
    }
}
