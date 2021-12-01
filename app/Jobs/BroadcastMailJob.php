<?php

namespace App\Jobs;

use App\Mail\BroadcastMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BroadcastMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 3;
    public $timeout = 120;

    private $emailAddress;
    private $content;
    public function __construct($emailAddress, $content)
    {
      $this->emailAddress = $emailAddress;
      $this->content = $content;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $broadcastEmail = new BroadcastMail($this->content);
      Mail::to($this->emailAddress)->send($broadcastEmail);
    }
}
