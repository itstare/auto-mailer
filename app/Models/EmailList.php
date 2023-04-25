<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function customers() {
    	return $this->hasMany(Customer::class);
    }

    public function unusedEmails() {
    	$unusedEmails = $this->customers()->where('used', false);

    	return $unusedEmails->count();
    }

    public function usedEmails() {
    	$usedEmails = $this->customers()->where('used', true);

    	return $usedEmails->count();
    }

    public function totalEmails() {
    	$totalEmails = $this->customers();

    	return $totalEmails->count();
    }

    public function formString() {
        return $this->title . ' (' . $this->unusedEmails() . ')';
    }
}
