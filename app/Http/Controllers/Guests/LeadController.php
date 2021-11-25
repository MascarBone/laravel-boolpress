<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Models\Lead;

class LeadController extends Controller
{

    /**
     * Show the form for creating a new Lead.
     *
     * @return \Illuminate\Http\Response
     */
    public function createForm()
    {
        return view('emails.createForm');
    }

    /**
     * Store the email in DB and send the message with Mail
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeForm(Request $request)
    {
        // dd($request->all());
        $lead = new Lead();
        $lead->fill($request->all());
        $lead->save();

        Mail::to('address_to_send@email.it')->send(new SendEmail($lead));

        return redirect()->route('guests.emails.thanks');
    }

    /**
     * Display a Greetings Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function thanks()
    {
        return view('emails.thanks');
    }
}
