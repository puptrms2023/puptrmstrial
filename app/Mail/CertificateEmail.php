<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\StudentApplicants;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $qrcode = base64_encode(QrCode::format('svg')->color(128, 0, 0)->size(200)->errorCorrection('H')->generate('Congrats'));
        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.send-awardees-certificates.certificate', $this->data, array('qrcode' => $qrcode));
        $pdf->setPaper('A4', 'landscape');

        return $this->from('info@gmail.com', 'Mailtrap')
            ->subject('Certificate from PUPT RMS')
            ->view('email.certificate-email')
            ->with(['data' => $this->data])
            ->attachData($pdf->output(), 'cert.pdf');
    }
}
