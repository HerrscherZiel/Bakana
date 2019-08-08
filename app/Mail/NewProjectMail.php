<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($projects)
    {
        //
        $this->projects = $projects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->projects;

        $pro = $this->projects;


//        dd($pro);

        return $this->from('magangbtv19@gmail.com')
            ->view('emailProject')
            ->with(
                [
                    'nama'  => auth()->user()->name,
                    'project'  => $pro,
                    'dead'  => 0,

                ]);
    }
}
