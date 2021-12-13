<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BroadcastMailPromo extends Mailable
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
      'link'  => $this->content->link,
//      'photo'  => $this->content->photoName,
    ];
    return $this->from(env('MAIL_FROM_ADDRESS'), config('constants_val.email_name'))
            ->subject(config('constants_val.broadcast_subject'))
            ->markdown('email.broadcast_mail_promo', compact('data'));
  }
}
