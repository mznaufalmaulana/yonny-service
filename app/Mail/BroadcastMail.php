<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BroadcastMail extends Mailable
{
    use Queueable, SerializesModels;

    private $content;
    public function __construct($content)
    {
      $this->content = $content;
    }

    public function build()
    {
      $data = [
        'body'  => $this->content->body,
      ];
      return $this->from(env('MAIL_FROM_ADDRESS'), config('constants_val.email_name'))
              ->subject(config('constants_val.broadcast_subject'))
              ->markdown('email.broadcast_email_plain', compact('data'));
    }
}
