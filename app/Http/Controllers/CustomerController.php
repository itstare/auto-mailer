<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\EmailList;

class CustomerController extends Controller
{
    public function search(Request $request, $id) {
    	$rules = [
    		'term' => ['required', 'string']
    	];
    	$request->validate($rules);

    	$search = $request->term;

    	$customers = Customer::query()->where('email_list_id', $id)->where('email', 'LIKE', "%{$search}%")->simplePaginate(25);

    	return view('list.view')->with([
    		'customers' => $customers,
    		'term' => $search
    	]);
    }

    public function resetAll($id) {
    	$list = EmailList::where('id', $id)->firstOrFail();
    	$emails = $list->customers()->update([
    		'used' => false
    	]);

    	return redirect()->route('home')->with(['status' => 'All emails reseted successfully.']);
    }

    public function delete($listId, $id) {
    	$email = Customer::where('email_list_id', $listId)->where('id', $id)->firstOrFail();
    	$email->delete();

    	return redirect()->route('list.view', $listId)->with(['status' => 'Email deleted successfully.']); 
    }
}
