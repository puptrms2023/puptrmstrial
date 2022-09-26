<?php

namespace App\Jobs;

use App\Mail\CertificateEmail;
use App\Mail\UserEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $details;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $data)
    {
        $this->details = $details;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new CertificateEmail($this->data);
        Mail::to($this->details['email'])->send($email);
    }
}
