<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class OtpSend extends Mailable
{
    use Queueable, SerializesModels;
  
    public $otp;
    public $subject;
  
    public function __construct($otp,$subject)
    {
        $this->otp = $otp;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('emails.otpsend');
    }
} 