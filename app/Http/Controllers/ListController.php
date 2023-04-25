<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ListImport;
use App\Models\EmailList;
use App\Models\Customer;

class ListController extends Controller
{
    public function import() {
    	return view('list.import');
    }

    public function upload(Request $request) {
    	$rules = [
    		'title' => ['required', 'string', Rule::unique('email_lists', 'title')],
    		'file' => ['required', File::types(['xlsx', 'xls'])]
    	];
    	$request->validate($rules);

    	Excel::import(new ListImport($request->title), $request->file('file'));

    	return redirect()->route('home')->with(['status' => 'List imported successfully.']);
    }

    public function index() {
    	$lists = EmailList::simplePaginate(25);

    	return view('list.index', compact('lists'));
    }

    public function view($id) {
    	$list = EmailList::where('id', $id)->firstOrFail();
    	$customers = $list->customers()->simplePaginate(25);

    	return view('list.view', compact('customers'));
    }

    public function edit($id) {
    	$list = EmailList::where('id', $id)->firstOrFail();

    	return view('list.edit', compact('list'));
    }

    public function update(Request $request, $id) {
    	$rules = [
    		'title' => ['required', 'string', Rule::unique('email_lists', 'title')->ignore($id)]
    	];
    	$request->validate($rules);

    	$list = EmailList::where('id', $id)->firstOrFail();

    	$list->update([
    		'title' => $request->title
    	]);

    	return redirect()->route('list.index')->with(['status' => 'List updated successfully.']);
    }

    public function delete($id) {
    	$list = EmailList::where('id', $id)->firstOrFail();
    	$emails = $list->customers();

    	$list->delete();
    	$emails->delete();

    	return redirect()->route('home')->with(['status' => 'List deleted successfully.']);
    }

    public function deleteAll() {
    	$lists = EmailList::all();

    	foreach ($lists as $list) {
    		$list->customers()->delete();
    		$list->delete();
    	}

    	return redirect()->route('home')->with(['status' => 'All lists deleted successfully.']);
    }

    public function search(Request $request) {
    	$rules = [
    		'term' => ['required', 'string']
    	];
    	$request->validate($rules);

    	$search = $request->term;

    	$lists = EmailList::query()->where('title', 'LIKE', "%{$search}%")->simplePaginate(25);

    	return view('list.index')->with([
    		'lists' => $lists,
    		'term' => $search
    	]);
    }
}
