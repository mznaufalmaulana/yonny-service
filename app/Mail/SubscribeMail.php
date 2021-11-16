<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscribeMail extends Mailable
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
        'title' => $this->content->title,
        'body'  => $this->content->body,
        'link'  => $this->content->link,
        'footer'  =>  $this->content->footer,
      ];
      return $this->markdown('email.subscribe_mail', compact('data'));
    }
}
