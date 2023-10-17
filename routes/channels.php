<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('offers', function ($user) {
    return ((int) $user->id) ? true : false;
});

Broadcast::channel('licenseIsExpiring', function ($user) {
    return ((int) $user->id) ? true : false;
});

Broadcast::channel('licenseIsExpired', function ($user) {
    return ((int) $user->id) ? true : false;
});

Broadcast::channel('licenseIsCreated', function ($user) {
    return ((int) $user->id) ? true : false;
});
