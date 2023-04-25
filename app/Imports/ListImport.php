<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\EmailList;
use App\Models\Customer;

class ListImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public $title;

    public function __construct($title) {
    	$this->title = $title;
    }

    public function collection(Collection $collection)
    {
    	$emailArray = Arr::collapse($collection);
    	$filteredArray = Arr::whereNotNull($emailArray);
    	
    	$errorMsgs = [];

    	foreach ($filteredArray as $email) {
    		if(!Str::containsAll($email, ['@', '.'])) {
    			$errorMsgs[] = $email . ' is not a valid email address.';
    		}
    	}

    	if(count($errorMsgs) > 0) {
    		throw ValidationException::withMessages($errorMsgs);
    	}

    	$emailList = EmailList::create([
    		'title' => $this->title
    	]);

    	foreach ($filteredArray as $email) {
    		Customer::create([
    			'email' => $email,
    			'email_list_id' => $emailList->id
    		]);
    	}
    }
}
