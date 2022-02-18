<?php

namespace App\Mails;

use App\Models\User;
use Illuminate\Mail\Mailable;

class EmailNotificationMail extends Mailable
{
    private User $user;

    private string $link;

    private int $linkExpires;

    /**
     * @param  \App\Models\User  $user
     * @param  string  $link
     * @param  int  $linkExpires
     */
    public function __construct(User $user, string $link, int $linkExpires)
    {
        $this->user = $user;
        $this->link = $link;
        $this->linkExpires = $linkExpires;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): EmailNotificationMail
    {
        $appName = config('app.name');


        return $this->view('mails.verifyEmail')
            ->subject("{$appName}: verify your Email")
            ->with('user', $this->user)
            ->with('link', $this->link)
            ->with('expired_at', $this->linkExpires);
    }
}
