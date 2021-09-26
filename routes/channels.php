<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int)$user->id === (int)$id;
});

/**
 * TODO: This needs to be evaluated...
 */
Broadcast::channel('application.{channel}', function ($user, $channel) {
    $file = \App\Models\Application\File::where('channel', $channel)->first();
    return $file->user_id == $user->id; // they may both be null for a guest user
});
