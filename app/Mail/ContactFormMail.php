<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;  // هنا غير الاسم

    public function __construct($message)
    {
        $this->contactMessage = $message;
    }

    public function build()
    {
        return $this->from('ibrahimbanour99@gmail.com', 'Ibrahim')
            ->replyTo($this->contactMessage->email, $this->contactMessage->name)
            ->subject($this->contactMessage->address ?? 'رسالة من نموذج الاتصال')
            ->view('emails.contact-form');
    }


}
