<?php /** @var \app\Models\User $user */ ?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>Welcome Email</title>
</head>
    <body>
        <h2>Welcome to the site, {{$user->full_name}}</h2>
            <br/>
        Your registered email is {{$user->email}} from web site  <a class="text-primary"  href="{{ config('app.url') }}">{{ config('app.url') }}</a>, Please click on the below link to "Verify Email" email account and create password.
        This link available in {{ $expired_at }} minutes time
        <br/>
        <a class="text-primary"  href=" {{ $link }}">Verify Email</a>
    </body>
</html>
