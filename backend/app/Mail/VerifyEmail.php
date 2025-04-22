<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $verificationUrl;

    public function __construct(string $token, string $email)
    {
        $this->token = $token;
        $this->email = $email;
        
        // This URL would be configured to match the frontend verification page
        // For now using a placeholder
        $frontendUrl = config('app.frontend_url', 'http://localhost:3000');
        $this->verificationUrl = "{$frontendUrl}/verify-email?token={$token}&email={$email}";
    }

    public function build()
    {
        return $this->subject('e-Yantra - Email Verification')
            ->view('emails.verify-email')
            ->with([
                'token' => $this->token,
                'email' => $this->email,
                'verificationUrl' => $this->verificationUrl
            ]);
    }
}