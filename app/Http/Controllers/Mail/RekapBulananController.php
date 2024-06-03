<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\RekapBulananMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RekapBulananController extends Controller
{
    public function sendEmail(Request $request)
    {
        $mailToParent = [
            'title' => 'Notification from Laravel',
            'body' => 'This is a test email for notification'
        ];

        Mail::to('nayokoilham@gmail.com')->send(new RekapBulananMail($mailToParent));

        return response()->json(['message' => 'Email sent successfully']);
    }
}
