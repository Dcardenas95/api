<?php

namespace App\Business;

use App\Models\User;

class AbilitiesResolver
{

  public static function resolve ( User $user, $device )
  {

    if ($user->role === 'client') {
      return static::resolveClient($device);
    }

  }

  public static function resolveClient ( $device )
  {

    return match ($device) {

      'watch' => [
        'establishment:show',
      ],

      default => [
        'establishment:show',
        'product:show',
        'orders:create',
        'orders:cancel',
      ],
    };
  }
}
