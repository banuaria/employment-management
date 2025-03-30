<?php

namespace App\Livewire\Main;

use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MainContact extends Component
{
    public $name;
    public $email;
    public $phone;
    public string $subject;
    public string $message;
    public $recaptchaToken;

    public $submitted = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|max:50',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
        'recaptchaToken' => ['required'],
    ];

    public function submit()
    {
        $this->validate();

        $response = Http::post(
            'https://www.google.com/recaptcha/api/siteverify?secret='.
            config('app.recaptcha_secret_key').
            '&response='.$this->recaptchaToken
        );

        $success = $response->json()['success'];
 
        if (! $success) {
            throw ValidationException::withMessages([
                'recaptchaToken' => __('Google thinks, you are a bot, please refresh and try again!'),
            ]);
        } else {
            $this->recaptchaToken = true;
        }

        $contact = Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        if($contact){

            $this->sendMail();

            $this->reset(['name', 'email', 'phone', 'subject', 'message', 'recaptchaToken']);

            $this->submitted = true;
        }
    }

    public function render()
    {
        return view('livewire.main.main-contact')->layout('layouts.main');
    }

    public function sendMail()
    {
        $email = $this->email;

        Mail::send('email.contact', [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'pesan' => $this->message
        ], function ($message) use ($email) {
            $message->to(config('app.mail_recipient'));
            $message->subject($this->subject);
        });
    }
}
