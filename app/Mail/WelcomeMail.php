<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = (Array)$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = env('FROM_MAIL');
        $name = "IndUserManagement";
        $subject = "Welcome to InduserManagement System";
        $data = [
            'name'=> $this->data['name'],
            'email' => $this->data['email']
        ];
        return $this->view('registrationMail')
                ->from($address, $name)
                ->subject($subject)
                ->with($data);
    }
}
