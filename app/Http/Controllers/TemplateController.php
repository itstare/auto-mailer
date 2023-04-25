<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Template;

class TemplateController extends Controller
{
    public function create() {
    	return view('template.create');
    }

    public function insert(Request $request) {
    	$rules = [
    		'title' => ['required', 'string', 'min:3', Rule::unique('templates', 'title')],
    		'body' => ['required']
    	];
    	$request->validate($rules);

    	Template::create([
    		'title' => $request->title,
    		'body' => $request->body
    	]);

    	return redirect()->route('home')->with(['status' => 'Template created successfully.']);
    }

    public function index() {
    	$templates = Template::simplePaginate(25);

    	return view('template.index', compact('templates'));
    }

    public function view($id) {
    	$template = Template::where('id', $id)->firstOrFail();

    	return view('template.view', compact('template'));
    }

    public function edit($id) {
    	$template = Template::where('id', $id)->firstOrFail();

    	return view('template.edit', compact('template'));
    }

    public function update(Request $request, $id) {
    	$rules = [
    		'title' => ['required', 'string', 'min:3', Rule::unique('templates', 'title')->ignore($id)],
    		'body' => ['required']
    	];
    	$request->validate($rules);

    	$template = Template::where('id', $id)->firstOrFail();

    	$template->update([
    		'title' => $request->title,
    		'body' => $request->body
    	]);

    	return redirect()->route('template.index')->with(['status' => 'Template updated successfully.']);
    }

    public function delete($id) {
    	$template = Template::where('id', $id)->firstOrFail();

    	$template->delete();

    	return redirect()->route('template.index')->with(['status' => 'Template deleted successfully.']);
    }

    public function search(Request $request) {
    	$rules = [
    		'term' => ['required', 'string']
    	];
    	$request->validate($rules);

    	$search = $request->term;

    	$templates = Template::query()->where('title', 'LIKE', "%{$search}%")->simplePaginate(25);

    	return view('template.index')->with([
    		'templates' => $templates,
    		'term' => $search
    	]);
    }

    public function deleteAll() {
    	$templates = Template::all();

    	foreach ($templates as $template) {
    		$template->delete();
    	}

    	return redirect()->route('home')->with(['status' => 'All templates deleted successfully.']);
    }
}
