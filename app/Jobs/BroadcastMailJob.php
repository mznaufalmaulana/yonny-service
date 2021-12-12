<?php

namespace App\Jobs;

use App\Mail\BroadcastMail;
use App\Mail\BroadcastMailPromo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BroadcastMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 60;
    private $emailAddress;
    private $content;
    public function __construct($emailAddress, $content)
    {
      $this->emailAddress = $emailAddress;
      $this->content = $content;
    }

    public function handle()
    {
      if ( 1 == $this->content->isPromo )
      {
        $broadcastEmail = new BroadcastMailPromo($this->content);
      }
      else
      {
        $broadcastEmail = new BroadcastMail($this->content);
      }
      Mail::to($this->emailAddress)->send($broadcastEmail);
    }
}
