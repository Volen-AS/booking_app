<?php

namespace App\Jobs;

use App\Mails\EmailNotificationMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Mail;


class VerifyEmailJob implements ShouldQueue
{
    use ResetsPasswords;

    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        $user = $this->user;

        $token = $this->broker()->createToken($user);

        $path = $this->link("/password/reset/{$token}", ['email' => $user->email]);

        Mail::to($user->email)->send(new EmailNotificationMail($user, $path, config('auth.passwords.users.expire')));

    }

    private function link(string $path, array $query): string
    {
        $scheme = env("HTTP_X_FORWARDED_PROTO", "https");

        $domain = env("APP_URL");

        $query =  '?' . http_build_query($query);

        return "{$scheme}://{$domain}{$path}{$query}";
    }
}
