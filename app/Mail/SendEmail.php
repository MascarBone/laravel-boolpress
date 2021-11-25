<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Lead;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Email with the structure of the Model
     *
     * @var Lead
     */
    public $lead;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Lead $_lead)
    {
        $this->lead = $_lead;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->lead->email, 'Boolpress')->view('emails.body');
    }
}
