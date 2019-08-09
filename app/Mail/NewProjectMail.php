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
    public function __construct($user , $projects)
    {
        //
        $this->projects = $projects;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->projects;
        $this->user;

        $pro    = $this->projects;
        $usher  = $this->user;



        return $this->from('magangbtv19@gmail.com')
            ->view('emailProject')
            ->with(
                [
                    'nama'      => $usher,
                    'project'   => $pro,
                    'dead'      => 0,

                ]);
    }
}
