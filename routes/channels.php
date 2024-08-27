<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('generalchat', function ($user) {
    return true;
});
