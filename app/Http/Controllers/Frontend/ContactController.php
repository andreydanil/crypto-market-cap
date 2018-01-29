<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Library\Consts;
use Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontend.contact');
    }

    public function store(ContactFormRequest $request)
    {
        $app_name = env(Consts::APP_NAME, Consts::DEFAULT_APP_NAME);
        $admin_email = env(Consts::ADMIN_EMAIL);

        if (null !== $admin_email) {
            try {
                Mail::send('emails.contact',
                    [
                        'app_name' => $app_name,
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'ip' => \request()->ip(),
                        'user_message' => $request->get('message')
                    ],
                    function ($msg) use ($app_name, $admin_email) {
                        $msg->from($admin_email);
                        $msg->to($admin_email)->subject("{$app_name} Feedback");
                    });
            } catch (\Exception $e) {
                \Log::error($e->getMessage());
            }
        }

        flash('Thank you for contacting us!')->success()->important();
        return redirect()->route('home.index');
    }
}
