<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['template_title', 'email_subject'];

    public function errors() {
    	return $this->hasMany(Error::class);
    }

    public function sentDate() {
    	$date = Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-M-Y H:i:s');

    	return $date;
    }

    public function noErrors() {
    	return $this->errors->count();
    }
}
