<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index() {
        return inertia('Admin/Email');
    }

    public function sendEmailToAll(Request $request) {
        $user = User::whereNotIn('id', [1])->get();

        if ($request->message != null && $request->subject != null) {
            $subject = $request->subject;
            $content = $request->message;

            foreach ($user as $us) {
                $name   = $us->name;
                $email  = $us->email;

                Mail::send('emails.bulk-mail', ['content' => $content, 'user' => $name], function ($message) use ($subject, $email, $name) {
                    $message->to($email, $name);
                    $message->subject($subject);
                });
            }
        } else {
            $request->session()->flash('flash.banner', 'A field should not be empty');
            $request->session()->flash('flash.bannerStyle', 'danger');

            return back()->with('error', 'A field should not be empty');
        }

        $request->session()->flash('flash.banner', 'Emails sent successfully');
        $request->session()->flash('flash.bannerStyle', 'success');

        return back();
    }
}
