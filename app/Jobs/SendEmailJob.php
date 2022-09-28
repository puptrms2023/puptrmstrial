<?php

namespace App\Jobs;

use App\Mail\CertEmail;
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
    public $studno;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details, $data, $studno)
    {
        $this->details = $details;
        $this->data = $data;
        $this->studno = $studno;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new CertEmail($this->data, $this->studno);
        Mail::to($this->details['email'])->send($email);
    }
}
