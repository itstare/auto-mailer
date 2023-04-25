<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;
use App\Imports\EmailImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use App\Models\Email;

class EmailController extends Controller
{
    public function import() {
    	return view('email.import');
    }

    public function upload(Request $request) {
    	$rules = [
    		'file' => ['required', File::types(['xlsx', 'xls'])]
    	];
    	$request->validate($rules);

    	Excel::import(new EmailImport, $request->file('file'));

    	return redirect()->route('home')->with(['status' => 'Emails imported successfully.']);
    }

    public function create() {
    	return view('email.create');
    }

    public function insert(Request $request) {
    	$rules = [
    		'email' => ['required', 'email', Rule::unique('emails', 'email')],
    		'password' => ['required']
    	];
    	$request->validate($rules);

    	Email::create([
    		'email' => $request->email,
    		'password' => $request->password
    	]);

    	return redirect()->route('home')->with(['status' => 'Email created successfully.']);
    }

    public function index() {
    	$emails = Email::simplePaginate(25);

    	return view('email.index', compact('emails'));
    }

    public function edit($id) {
    	$email = Email::where('id', $id)->firstOrFail();

    	return view('email.edit', compact('email'));
    }

    public function update(Request $request, $id) {
    	$email = Email::where('id', $id)->firstOrFail();

    	$rules = [
    		'email' => ['required', 'email', Rule::unique('emails', 'email')->ignore($id)],
    		'password' => ['required']
    	];
    	$request->validate($rules);

    	$email->update([
    		'email' => $request->email,
    		'password' => $request->password
    	]);

    	return redirect()->route('email.index')->with(['status' => 'Email updated successfully.']);
    }

    public function delete($id) {
    	$email = Email::where('id', $id)->firstOrFail();

    	$email->delete();

    	return redirect()->route('email.index')->with(['status' => 'Email deleted successfully.']);
    }

    public function reset($id) {
    	$email = Email::where('id', $id)->firstOrFail();

    	$email->update([
    		'already_used' => false
    	]);

    	return redirect()->route('email.index')->with(['status' => 'Email activated successfully.']);
    }

    public function resetAll() {
    	$emails = Email::all();
    	
    	foreach ($emails as $email) {
    		$email->update([
    			'already_used' => false
    		]);
    	}

    	return redirect()->route('home')->with(['status' => 'All emails activated successfully.']);
    }

    public function deleteAll() {
    	$emails = Email::all();

    	foreach ($emails as $email) {
    		$email->delete();
    	}

    	return redirect()->route('home')->with(['status' => 'All emails deleted successfully.']);
    }

    public function search(Request $request) {
    	$rules = [
    		'term' => ['required', 'string']
    	];
    	$request->validate($rules);

    	$search = $request->term;

    	$emails = Email::query()->where('email', 'LIKE', "%{$search}%")->simplePaginate(25);

    	return view('email.index')->with([
    		'emails' => $emails,
    		'term' => $search
    	]);
    }
}
