<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $content;
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $data = [
        'body'  => $this->content->body,
      ];
      return $this->from(env('MAIL_FROM_ADDRESS'), config('constants_val.email_name'))
                    ->subject(config('constants_val.send_subject'))
                    ->text('email.send_mail', compact('data'));
    }
}
