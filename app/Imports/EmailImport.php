<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\Email;

class EmailImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
    	Validator::make($collection->toArray(), [
             '*.0' => ['required', 'email', Rule::unique('emails', 'email')],
             '*.1' => ['required']
         ], 
         [
         	'*.0.required' => 'Some email fields are empty, please check.',
         	'*.0.email' => ':input is not a valid email address.',
         	'*.0.unique' => ':input already exists.',
         	'*.1.required' => 'Some password fields are empty, please check.'
         ])->validate();

        foreach ($collection as $row) {
        	Email::create([
        		'email' => $row[0],
        		'password' => $row[1]
        	]);
        }
    }
}
