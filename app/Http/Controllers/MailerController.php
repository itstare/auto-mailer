<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailList;
use App\Models\Email;
use App\Models\Template;
use App\Models\Customer;
use App\Models\Session;
use App\Models\Error;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Exception;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Symfony\Component\Mime\Email as SymfonyEmail;
use Symfony\Component\Mime\Address;

class MailerController extends Controller
{
	public array $errors;

    public function index() {
    	$emailLists = EmailList::all();
    	$emails = Email::where('already_used', false)->get();
    	$templates = Template::all();

    	return view('welcome')->with([
    		'emailLists' => $emailLists,
    		'emails' => $emails->count(),
    		'templates' => $templates
    	]);
    }

    public function send(Request $request) {
    	$rules = [
    		'list' => ['required', Rule::exists('email_lists', 'id')],
    		'emails' => ['required', 'integer', 'min:1'],
    		'template' => ['required', Rule::exists('templates', 'id')],
    		'subject' => ['required', 'string']
    	];
    	$request->validate($rules);

    	$list = EmailList::where('id', $request->list)->first();

    	if($list->unusedEmails() < 1) {
    		throw ValidationException::withMessages(['list' => 'There are no available emails for this list. Please select another one.']);
    	}

    	$maxEmails = Email::where('already_used', false)->get();

    	if($maxEmails->count() < $request->emails) {
    		throw ValidationException::withMessages(['emails' => 'The maximum number of emails that can be used is ' . $maxEmails->count() . '.']);
    	}

    	$emails = Email::where('already_used', false)->take($request->emails)->get();
    	$template = Template::where('id', $request->template)->first();

    	foreach ($emails as $email) {
    		try {
                $customerCount = Customer::where('used', false)->where('email_list_id', $request->list)->count();

                if($customerCount >= 500) {
                    $takeCustomers = 500;
                } else if($customerCount == 0) {
                    return redirect()->route('home')->with(['status' => 'Process completed. All emails inside given list have been used.']);
                } else {
                    $takeCustomers = $customerCount;
                }

                $customers = Customer::where('used', false)->where('email_list_id', $request->list)->take($takeCustomers)->get();
                
    			$transport = new EsmtpTransport('smtp-mail.outlook.com', 587);
	    		$transport->setUsername($email->email);
	    		$transport->setPassword($email->password);

	    		$mailer = new Mailer($transport);

	    		$mailable = (new SymfonyEmail())->from($email->email)->bcc(...$customers->pluck('email')->toArray())->subject($request->subject)->html($template->body);

	   			$mailer->send($mailable);

	   			$email->update([
	   				'already_used' => true
	   			]);

                $customers->each(function ($customer) {
                    $customer->update([
                        'used' => true
                    ]);
                });
    		} catch(Exception $error) {
    			$this->errors[] = (object) ['email_id' => $email->id, 'error_msg' => $error->getMessage()];
    		}
    	}

    	$template->update([
    		'last_used' => Carbon::now()
    	]);

    	$session = Session::create([
    		'template_title' => $template->title,
    		'email_subject' => $request->subject
    	]);

    	if(isset($this->errors)) {
	    	foreach($this->errors as $error) {
	    		Error::create([
	    			'email_id' => $error->email_id,
	    			'error_msg' => $error->error_msg,
	    			'session_id' => $session->id
	    		]);
	    	}
    	}

        return redirect()->route('home')->with(['status' => 'Process completed.']);
    }
}
