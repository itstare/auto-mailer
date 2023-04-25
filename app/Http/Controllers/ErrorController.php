<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Session;
use App\Models\Error;

class ErrorController extends Controller
{
    public function index() {
    	$logs = Session::simplePaginate(20);

    	return view('error.index', compact('logs'));
    }

    public function delete($id) {
    	$session = Session::where('id', $id)->firstOrFail();

    	$session->errors()->delete();
    	$session->delete();

    	return redirect()->route('error.index')->with(['status' => 'Session deleted successfully.']);
    }

    public function deleteAll() {
    	$sessions = Session::all();

    	foreach ($sessions as $session) {
    		$session->errors()->delete();
    		$session->delete();
    	}

    	return redirect()->route('home')->with(['status' => 'All sessions deleted successfully.']);
    }

    public function view($id) {
    	$errors = Error::where('session_id', $id)->simplePaginate(20);

    	return view('error.view')->with([
    		'errors' => $errors,
    		'id' => $id
    	]);
    }

    public function deleteAllErrors($id) {
    	$session = Session::where('id', $id)->firstOrFail();
    	$session->errors()->delete();

    	return redirect()->route('error.index')->with(['status' => 'Errors deleted successfully.']);
    }

    public function deleteError($id, $sessionId) {
    	$error = Error::where('id', $id)->firstOrFail();
    	$error->delete();

    	return redirect()->route('error.view', $sessionId)->with(['status' => 'Error deleted successfully.']);
    }
}
