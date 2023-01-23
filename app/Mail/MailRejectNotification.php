<?php

namespace App\Mail;

use App\Models\RegisterRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailRejectNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $request;

    public function __construct(RegisterRequest $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('admin@helpdesk.com')->subject('Permohonan registrasi ditolak')->view('mail-reject')->with([
            'nama' => $this->request->name,
        ]);
    }
}
