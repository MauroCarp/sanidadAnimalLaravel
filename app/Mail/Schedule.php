<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Schedule extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $subject = 'Cronograma Vacunador';
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
        return $this->view('emails.schedule')->attach(asset('pdf/schedule.pdf'),['as'=>'Cronograma ' . date('d-m-Y') . ".pdf",'mime' => 'application/pdf']);
    }
}
