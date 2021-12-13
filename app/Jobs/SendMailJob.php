<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
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
        $sendMail = new SendMail($this->content);
        Mail::to($this->emailAddress)->send($sendMail);
    }
}