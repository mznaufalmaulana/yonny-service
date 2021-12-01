<?php

namespace App\Jobs;

use App\Mail\SubscribeMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SubscribeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
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
        $subEmail = new SubscribeMail($this->content);
        Mail::to($this->emailAddress)->send($subEmail);
    }
}
